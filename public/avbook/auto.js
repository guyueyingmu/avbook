// ==UserScript==
// @name         JAV老司机
// @namespace    https://sleazyfork.org/zh-CN/users/85065
// @version      1.0.0
// @description  JAV老司机神器,支持javlibrary.com、javbus.com、avmo.pw、avso.pw等老司机站点。拥有JAV高清预览大图，JAV列表无限滚动自动加载，合成“挊”的自动获取JAV磁链接，一键自动115离线下载，优化成高效浏览的页面排版。
// @author       Hobby

// @require      http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.4.min.js
// @require      http://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js
// @resource     icon http://geekdream.com/image/115helper_icon_001.jpg

// @include     https://www.javbus.com/*
// @include     https://www.javbus2.com/*
// @include     https://www.javbus3.com/*
// @include     https://www.javbus5.com/*
// @include     https://www.javbus.me/*
// @match        http*://www.javbus.com/*

// @match        http*://*avmo.pw/*
// @match        http*://*avso.pw/*

// @include     http*://*javlibrary.com/*
// @include     http*://*5avlib.com/*
// @include     http*://*look4lib.com/*
// @include     http*://*javlib3.com/*
// @include     http*://*javli6.com/*
// @include     http*://*j8vlib.com/*
// @include     http*://*j9lib.com/*

// @match        http://115.com/*
// @match        http*://avdb.la/movie/*

// @run-at       document-idle
// @grant        GM_xmlhttpRequest
// @grant        GM_addStyle
// @grant        GM_getValue
// @grant        GM_setValue
// @grant        GM_notification
// @grant        GM_setClipboard
// @grant        GM_getResourceURL

// @connect      blogjav.net
// @connect      pixhost.org
// @connect      115.com
// @connect      btso.pw
// @connect      btdb.in

// @copyright    hobby 2016-12-18

// 大陆用户推荐Chrome + Tampermonkey（必须扩展） + XX-Net(代理) + Proxy SwitchyOmega（扩展）的环境下配合使用。

// v1.0.0 支持javlibrary.com、javbus.com、avmo.pw、avso.pw等老司机站点，第一版发布。

// ==/UserScript==
/* jshint -W097 */
(function() {
	'use strict';
	var jav_userID = 0; //115用户ID
	//icon图标
	var icon = GM_getResourceURL('icon');

	var common = {
		parsetext: function(text) {
			var doc = null;
			try {
				doc = document.implementation.createHTMLDocument('');
				doc.documentElement.innerHTML = text;
				return doc;
			}
			catch (e) {
				alert('parse error');
			}
		},
		//方法: 通用chrome通知
		notifiy:function (title, body, icon, click_url)
		{

			var notificationDetails = {
				text: body,
				title: title,
				timeout: 10000,
				image: icon,
				onclick: function() {
					window.open(click_url);
				}
			};
			GM_notification(notificationDetails);
		},
		addAvImg:function(avid, func){
			//异步请求搜索blogjav.net的番号
			GM_xmlhttpRequest({
				method: "GET",
				//大图地址
				url: 'http://blogjav.net/?s='+avid,
				onload: function(result) {
					var doc = common.parsetext(result.responseText);
					var a = doc.getElementsByClassName('more-link')[0];
					if (a) {
						//异步请求调用内页详情的访问地址
						GM_xmlhttpRequest({
							method: "GET",
							//大图地址
							url: a.href,
							headers:{
								referrer:  "http://pixhost.org/" //绕过防盗图的关键
							},
							onload: function(XMLHttpRequest) {
								var bodyStr = XMLHttpRequest.responseText;
								var yixieBody = bodyStr.substring(bodyStr.search(/<span id="more-(\S*)"><\/span>/),bodyStr.search(/<div class="category/));

								var img_start_idx = yixieBody.search(/"><img .*src="https*:\/\/(\S*)pixhost.org\/thumbs\//);
								//如果找到内容大图
								if( img_start_idx > 0)
								{
									var new_img_src = yixieBody.substring(yixieBody.indexOf('src',img_start_idx) + 5,yixieBody.indexOf('alt') - 2);
									var targetImgUrl = new_img_src.replace('thumbs','images').replace('//t','//img');
									console.log("图片地址:"+targetImgUrl);

									//创建img元素,加载目标图片地址
									var $img = $(document.createElement("img"));
									$img.attr("src",targetImgUrl);
									$img.attr("style","float: left;");

									//将新img元素插入指定位置
									func($img);
									/*var divEle = $("div[class='col-md-3 info']")[0];
									if (divEle) {
										$(divEle.parentElement).append($img);
										$img.click(function(){
											$(this).toggleClass('min');
											if($(this).attr("class")){
												this.parentElement.parentElement.scrollIntoView();
											}
										});
										//$img.load(function() {
										//    console.log('load compeleted');
										//});
									}*/
								}
							},
							onerror: function(e) {
								console.log(e);
							}
						});//end  GM_xmlhttpRequest
					}
				},
				onerror: function(e) {
					console.log(e);
				}
			});//end  GM_xmlhttpRequest
		},
	};

	var main = {
		//av信息查询 类
		jav: {
			type: 0,
			re: /(avmo|avso|avxo).*movie.*/,
			vid: function() {
				return $('.header')[0].nextElementSibling.innerHTML;
			},
			proc: function() {
				//insert_after('#movie-share');
				var divE = $("div[class='col-md-3 info']")[0];
				$(divE).after(main.cur_tab);
				//$(main.cur_tab).before($('#movie-share')[0]);
			}
		},
		javbus: {
			type: 0,
			re: /javbus/,
			vid: function() {
				var a = $('.header')[0].nextElementSibling;
				return a ? a.textContent : '';
			},
			proc: function() {
				var divE = $("div[class='col-md-3 info']")[0];
				//var p = document.createElement('p');
				//p.className = 'hobby';
				//divE.parentElement.appendChild(p);
				$(divE).after(main.cur_tab);
			}
		},
		javlibrary: {
			type: 0,
			re: /(javlibrary|javlib3|look4lib|5avlib|javli6|j8vlib|j9lib).*\?v=.*/,
			vid: function() {
				return $('#video_id')[0].getElementsByClassName('text')[0].innerHTML;
			},
			proc: function() {
				//insert_after('#video_info');
				//<td style="vertical-align: top;">
				$('.socialmedia').remove();
				GM_addStyle('#video_info{text-align: left;font: 14px Arial;min-width: 100px;max-width: 260px;}');

				var tdE = $("td[style='vertical-align: top;']")[0];
				$(tdE.parentElement).append('<td id="hobby" style="vertical-align: top;"></td>');
				$('#hobby').append(main.cur_tab);
			}
		},
	};

	// 挊
	var main_keys = Object.keys(main); //下面的不要出现
	main.cur_tab = null;
	main.cur_vid = '';

	// 第三方脚本调用
	var thirdparty = {
		// 挊
		offline_sites : {
			115: {
				name: '115离线',
				url: 'http://115.com/?tab=offline&mode=wangpan',
				enable: true,
			},
		},
		// 挊
		searchMagnetRun: function() {
			for (var i = 0; i < main_keys.length; i++) {
				var v = main[main_keys[i]];

				//for javlibrary
				if($("#adultwarningprompt")[0] !== null){
					//$("#adultwarningprompt input")[0].click();
				}

				if (v.re.test(location.href)) {
					if (v.type === 0) {
						try {
							main.cur_vid = v.vid();
						}
						catch (e) {
							main.cur_vid = '';
						}
						if (main.cur_vid) {
							GM_addStyle([
								'#nong-table-new{margin:10px auto;color:#666 !important;font-size:13px;text-align:center;background-color: #F2F2F2;}',
								'#nong-table-new th,#nong-table-new td{text-align: center;height:30px;background-color: #FFF;padding:0 1em 0;border: 1px solid #EFEFEF;}',
								'.jav-nong-row{text-align: center;height:30px;background-color: #FFF;padding:0 1em 0;border: 1px solid #EFEFEF;}',
								'.nong-copy{color:#08c !important;}',
								'.nong-offline{text-align: center;}',
								'#jav-nong-head a {margin-right: 5px;}',
								'.nong-offline-download{color: rgb(0, 180, 30) !important; margin-right: 4px !important;}',
								'.nong-offline-download:hover{color:red !important;}',
							].join(''));
							main.cur_tab = thirdparty.magnet_table.full();
							console.log('番号：', main.cur_vid);
							v.proc();

							// console.log(main.cur_tab)
							var t = $('#jav-nong-head')[0].firstChild;
							t.firstChild.addEventListener('change', function(e) {
								console.log(e.target.value);
								GM_setValue('search_index', e.target.value);
								var s = $('#nong-table-new')[0];
								s.parentElement.removeChild(s);
								thirdparty.searchMagnetRun();
							});

							thirdparty.search_engines.cur_engine(main.cur_vid, function(src, data) {
								if (data.length === 0) {
									$('#nong-table-new')[0].querySelectorAll('#notice')[0].textContent = 'No search result';
								}
								else {
									thirdparty.magnet_table.updata_table(src, data, 'full');
									/*display search url*/
									var y = $('#jav-nong-head th')[1].firstChild;
									y.href = thirdparty.search_engines.full_url;
								}
							});
						}
					}
					break;
				}
			}
		},
		// 挊
		search_engines : {
			switch_engine: function(i) {
				// var index = GM_getValue("search_index",0);
				GM_setValue('search_index', i);
				return i;
			},
			cur_engine: function(kw, cb) {
				var z = this[GM_getValue('search_index', 0)];
				if(!z){
					alert("search engine not found");
				}
				return z(kw, cb);
			},
			parse_error:function(a){
				alert("调用搜索引擎错误，可能需要更新，请向作者反馈。i="+ a);
			},
			full_url: '',
			0: function(kw, cb) {
				GM_xmlhttpRequest({
					method: 'GET',
					url: 'https://btso.pw/search/' + kw,
					onload: function(result) {
						thirdparty.search_engines.full_url = result.finalUrl;
						var doc = common.parsetext(result.responseText);
						if (!doc) {
							thirdparty.search_engines.parse_error(GM_getValue('search_index'));
						}
						var data = [];
						var t = doc.getElementsByClassName('data-list')[0];
						if (t) {
							var a = t.getElementsByTagName('a');
							for (var i = 0; i < a.length; i++) {
								if (!a[i].className.match('btn')) {
									data.push({
										'title': a[i].title,
										'maglink': 'magnet:?xt=urn:btih:' + a[i].outerHTML.replace(/.*hash\//, '').replace(/" .*\n.*\n.*\n.*/, ''),
										'size': a[i].nextElementSibling.textContent,
										'src': a[i].href,
									});
								}
							}
						}
						cb(result.finalUrl, data);
					},
					onerror: function(e) {
						console.log(e);
					}
				});
			},
			1: function(kw, cb) {
				GM_xmlhttpRequest({
					method: 'GET',
					url: 'https://btdb.in/q/' + kw + '/',
					onload: function(result) {
						thirdparty.search_engines.full_url = result.finalUrl;
						var doc = common.parsetext(result.responseText);
						if(!doc){
							thirdparty.search_engines.parse_error(GM_getValue('search_index'));
						}
						var data = [];
						var elems = doc.getElementsByClassName('item-title');
						for (var i = 0; i < elems.length; i++) {
							data.push({
								'title': elems[i].firstChild.title,
								'maglink': elems[i].nextElementSibling.firstElementChild.href,
								'size': elems[i].nextElementSibling.children[1].textContent,
								'src': 'https://btdb.in' + elems[i].firstChild.getAttribute('href'),
							});
						}
						console.log(data);
						cb(result.finalUrl, data);
					},
					onerror: function(e) {
						console.log(e);
					}
				});
			},
		},
		// 挊 
		magnet_table : {
			template: {
				create_head: function() {
					var a = document.createElement('tr');
					a.className = 'jav-nong-row';
					a.id = 'jav-nong-head';
					var list = [
						'标题',
						'大小',
						'操作',
						'离线下载'
					];
					for (var i = 0; i < list.length; i++) {
						var b = this.head.cloneNode(true);
						if (i === 0) {
							var select = document.createElement("select");
							var ops = ["btio", "btdb"];
							var cur_index = GM_getValue("search_index",0);
							for (var j = 0; j < ops.length; j++) {
								var op = document.createElement("option");
								op.value = j.toString();
								op.textContent = ops[j];
								if (cur_index == j) {
									op.setAttribute("selected", "selected");
								}
								select.appendChild(op);
							}
							b.removeChild(b.firstChild);
							b.appendChild(select);
							a.appendChild(b);
							continue;
						}
						b.firstChild.textContent = list[i];
						a.appendChild(b);
					}
					// var select_box = this.create_select_box();
					// a.firstChild.appendChild(select_box);

					return a;
				},
				create_row: function(data) {
					var a = document.createElement('tr');
					a.className = 'jav-nong-row';
					a.setAttribute('maglink', data.maglink);
					var b = document.createElement('td');
					var list = [
						this.create_info(data.title, data.maglink),
						this.create_size(data.size, data.src),
						this.create_operation(data.maglink),
						this.create_offline()
					];
					for (var i = 0; i < list.length; i++) {
						var c = b.cloneNode(true);
						c.appendChild(list[i]);
						a.appendChild(c);
					}
					return a;
				},
				create_loading: function() {
					var a = document.createElement('tr');
					a.className = 'jav-nong-row';
					var p = document.createElement('p');
					p.textContent = 'Loading';
					p.id = 'notice';
					a.appendChild(p);
					return a;
				},
				create_info: function(title, maglink) {
					var a = this.info.cloneNode(true);
					a.firstChild.textContent = title.length < 20 ? title : title.substr(0, 20) + '...';
					a.firstChild.href = maglink;
					a.title = title;
					return a;
				},
				create_size: function(size, src) {
					var a = this.size.cloneNode(true);
					a.textContent = size;
					a.href = src;
					return a;
				},
				create_operation: function(maglink) {
					var a = this.operation.cloneNode(true);
					a.firstChild.href = maglink;
					return a;
				},
				create_offline: function() {    //有用 hobby
					var a = this.offline();
					a.className = 'nong-offline';
					return a;
				},
				create_select_box: function() {
					var select_box = document.createElement('select');
					select_box.id = 'nong-search-select';
					select_box.setAttribute('title', '切换搜索结果');
					var search_name = GM_getValue('search', default_search_name);
					for (var k in thirdparty.search_engines) {
						var o = document.createElement('option');
						if (k == search_name) {
							o.setAttribute('selected', 'selected');
						}
						o.setAttribute('value', k);
						o.textContent = k;
						select_box.appendChild(o);
					}
					return select_box;
				},
				head: (function() {
					var a = document.createElement('th');
					var b = document.createElement('a');
					a.appendChild(b);
					return a;
				})(),
				info: (function() {
					var a = document.createElement('div');
					var b = document.createElement('a');
					b.textContent = 'name';
					b.href = 'src';
					a.appendChild(b);
					return a;
				})(),
				size: function() {
					var a = document.createElement('a');
					a.textContent = 'size';
					return a;
				}(),
				operation: (function() {
					var a = document.createElement('div');
					var copy = document.createElement('a');
					copy.className = 'nong-copy';
					copy.textContent = '复制';
					a.appendChild(copy);
					return a;
				})(),
				offline: function() {
					var a = document.createElement('div');
					var b = document.createElement('a');
					b.className = 'nong-offline-download';
					b.target = '_blank';
					//debugger;
					for (var k in thirdparty.offline_sites) {
						if (thirdparty.offline_sites[k].enable) {
							var c = b.cloneNode(true);
							c.href = thirdparty.offline_sites[k].url;
							c.textContent = thirdparty.offline_sites[k].name;
							a.appendChild(c);
						}
					}
					return a;
				},
			},
			create_empty_table: function() {   //有用 hobby
				var a = document.createElement('table');
				a.id = 'nong-table-new';
				return a;
			},
			updata_table: function(src, data, type) {
				if (type == 'full') {
					var tab = $('#nong-table-new')[0];
					tab.removeChild(tab.querySelector("#notice").parentElement);
					for (var i = 0; i < data.length; i++) {
						tab.appendChild(thirdparty.magnet_table.template.create_row(data[i]));
					}
				}
				// else if(type =='mini'){
				// }

				this.reg_event();
			},
			full: function(src, data) {
				var tab = this.create_empty_table();
				tab.appendChild(thirdparty.magnet_table.template.create_head());
				// for (var i = 0; i < data.length; i++) {
				//     tab.appendChild(thirdparty.magnet_table.template.create_row(data[i]))
				// }
				var loading = thirdparty.magnet_table.template.create_loading();
				tab.appendChild(loading);
				return tab;
			},
			handle_event: function(event) {
				if (event.target.className == 'nong-copy') {
					event.target.innerHTML = '成功';
					GM_setClipboard(event.target.href);
					setTimeout(function() {
						event.target.innerHTML = '复制';
					}, 1000);
					event.preventDefault(); //阻止跳转
				}
				else if (event.target.className == 'nong-offline-download') {
					var maglink = event.target.parentElement.parentElement.getAttribute('maglink') || event.target.parentElement.parentElement.parentElement.getAttribute('maglink');
					GM_setValue('magnet', maglink);

					var token_url = 'http://115.com/?ct=offline&ac=space&_='; //获取115 token接口
					GM_xmlhttpRequest({
						method: 'GET',
						url: token_url + new Date().getTime(),
						onload: function (responseDetails)
						{
							if (responseDetails.responseText.indexOf('html') >= 0) {
								//未登录处理
								common.notifiy("115还没有登录",
											   '请先登录115账户后,再离线下载！',
											   icon,
											   'http://115.com/?mode=login'
											  );
								return false;
							}
							var sign115 = JSON.parse(responseDetails.response).sign;
							var time115 = JSON.parse(responseDetails.response).time;
							console.log("uid="+ jav_userID+" sign:"+sign115+" time:"+ time115);
							console.log("rsp:"+responseDetails.response);
							GM_xmlhttpRequest({
								method: 'POST',
								url: 'http://115.com/web/lixian/?ct=lixian&ac=add_task_url', //添加115离线任务接口
								headers:{
									"Content-Type":"application/x-www-form-urlencoded"
								},
								data:"url="+encodeURIComponent(maglink)+"&uid="+ jav_userID + "&sign="+sign115+"&time="+time115, //uid=1034119 ,hobby的
								onload: function (responseDetails) {
									var lxRs = JSON.parse(responseDetails.responseText); //离线结果
									if (lxRs.state) {
										//离线任务添加成功
										common.notifiy("115老司机自动开车",
													   '离线任务添加成功',
													   icon,
													   'http://115.com/?tab=offline&mode=wangpan'
													  );
									}
									else{
										//离线任务添加失败
										if(lxRs.errcode == '911'){
											lxRs.error_msg = '你的帐号使用异常，需要在线手工重新验证即可正常使用。';
										}
										common.notifiy("失败了",
													   '请重新打开115,'+lxRs.error_msg,
													   icon,
													   'http://115.com/?tab=offline&mode=wangpan'
													  );
									}
									console.log("sign:"+sign115+" time:"+ time115);
									console.log("磁链:"+maglink+" 下载结果:"+ lxRs.state+" 原因:"+lxRs.error_msg);
									console.log("rsp:"+responseDetails.response);
								}
							});
						}
					});
					event.preventDefault(); //阻止跳转
				}
			},
			reg_event: function() { //TODO target 处理 更精准
				var list = [
					'.nong-copy',
					'.nong-offline-download'
				];
				for (var i = 0; i < list.length; i++) {
					var a = document.querySelectorAll(list[i]);
					for (var u = 0; u < a.length; u++) {
						a[u].addEventListener('click', this.handle_event, false);
					}
				}
				// var b = document.querySelectorAll('#nong-search-select')[0];
				// b.addEventListener('change', this.handle_event, false);

			},
		},
		// 登录115执行脚本，自动离线下载准备步骤
		login115Run: function(){
			jav_userID = GM_getValue('jav_user_id', 0); //115用户ID缓存
			//获取115ID
			if (jav_userID === 0) {
				if (location.host.indexOf('115.com') >= 0) {
					if (typeof (window.wrappedJSObject.user_id) != 'undefined') {
						jav_userID = window.wrappedJSObject.user_id;
						GM_setValue('jav_user_id', jav_userID);
						alert('115登陆成功！');
						return;
					}
				} else {
					//alert('请先登录115账户！');
					common.notifiy("115还没有登录",
								   '请先登录115账户后,再离线下载！',
								   icon,
								   'http://115.com/?mode=login'
								  );
					GM_setValue('jav_user_id', 0);
				}
			}

			if (location.host.indexOf('115.com') >= 0)
			{
				/*if(location.href.indexOf('#115helper') < 0)
				{
					console.log("jav老司机:115.com, 不初始化.");
					return false;
				}*/
				console.log('jav老司机:115.com,尝试获取userid.');
				jav_userID = GM_getValue('jav_user_id', 0);
				//debugger;
				if(jav_userID !== 0)
				{
					console.log("jav老司机: 115账号:"+jav_userID+",无需初始化.");
					return false;
				}
				jav_userID = $.cookie("OOFL");
				console.log("jav老司机: 115账号:"+jav_userID);
				if(!jav_userID)
				{
					console.log("jav老司机: 尚未登录115账号");
					return false;
				}else{
					console.log("jav老司机: 初始化成功");
					common.notifiy('老司机自动开车', '登陆初始化成功,赶紧上车把!', icon, "");
					GM_setValue('jav_user_id', jav_userID);
				}
				return false;
			}
		},
	};


	class Lock {
		constructor(d = false) {
			this.locked = d;
		}
		lock() {
			this.locked = true;
		}
		unlock() {
			this.locked = false;
		}
	}

	function fetchURL(url) {
		console.log(`fetchUrl = ${url}`);

		return fetch(url, {
			credentials: 'same-origin'
		})
			.then((response) => {
			return response.text();
		})
			.then((html) => {
			return new DOMParser().parseFromString(html, 'text/html');
		})
			.then((doc) => {
			let $doc = $(doc);
			let nextHref;
			if($doc.find('a#next').length){
				nextHref = $doc.find('a#next').attr('href');
			}
			else if($doc.find('a[name="nextpage"]').length){
				nextHref = $doc.find('a[name="nextpage"]').attr('href');
			}
			// javlibrary
			else if($doc.find('a[class="page next"]').length){
				nextHref = $doc.find('a[class="page next"]').attr('href');
			}

			let nextURL = nextHref ? `${location.protocol}//${location.host}${nextHref}` : undefined;
			let elems = $doc.find('div#waterfall div.item');
			if(!elems.length){
				elems = $doc.find('div.videos div.video');
			}

			return {
				nextURL,
				elems
			};
		});
	}

	function* fetchSync(urli) {
		let url = urli;
		do {
			yield new Promise((resolve, reject) => {
				if (mutex.locked) {
					reject();
				} else {
					mutex.lock();
					resolve();
				}
			}).then(() => {
				return fetchURL(url).then(info => {
					url = info.nextURL;
					return info.elems;
				});
			}).then(elems => {
				mutex.unlock();
				return elems;
			}).catch((err) => {
				// Locked!
			});
		} while (url);
	}

	function appendElems(arg) {
		let nextpage = pagegen.next();
		if (!nextpage.done) {
			nextpage.value.then(elems => {
				/* show .avatar-box only in first page */
				$('#waterfall').append((!arg) ? elems.slice(1) : elems);
			});
		}
		return nextpage.done;
	}

	function xbottom(elem, limit) {
		return (elem.getBoundingClientRect().top - $(window).height()) < limit;
	}

	function end() {
		console.info('The End');
		$(document).off('scroll');
		$(document).off('wheel');
		$(anchor).replaceWith($(`<h1>The End</h1>`));
	}

	function scroll() {
		if (xbottom(anchor, 500) && appendElems()) {
			end();
		}
	}

	function wheel() {
		if (xbottom(anchor, 1000) && appendElems()) {
			end();
		}
	}

	function scrollInit($pages){
		$(document).on('scroll', scroll);
		$(document).on('wheel', wheel);
		$pages.remove();
		appendElems('first');
		GM_addStyle([
			'#waterfall {height: initial !important;width: initial !important;display: flex;flex-direction: row;flex-wrap: wrap;}',
			'#waterfall .item.item {osition: relative !important;top: initial !important;left: initial !important;float: none;flex: 20%;}',
			'#waterfall .movie-box,#waterfall .avatar-box {width: initial !important;display: flex;}',
			'#waterfall .movie-box .photo-frame {overflow: visible;}',
		].join(''));
	}

	//$(document).ready(function() { //DOMContentLoaded
	//$(document).load(function() { //load
	thirdparty.login115Run();

	GM_addStyle([
		'.min{width:66px;min-height: 233px;height:auto;cursor: pointer;}',
		'.container {width: 100%;float: left;}',
		'.col-md-3 {float: left;max-width: 260px;}',
		'.col-md-9 {width: inherit;}',
		'.footer {padding: 20px 0;background: #1d1a18;float: left;}',
		'#nong-table-new {margin: initial !important;important;color: #666 !important;font-size: 13px;text-align: center;background-color: #F2F2F2;float: left;}',
	].join(''));

	// 挊
	if(GM_getValue('search_index',null) === null){
		GM_setValue('search_index',0);
	}
	thirdparty.searchMagnetRun();

	//获取所有番号影片链接的a元素
	var a_array = $("div[class='item'] a");
	for (var index = 0; index < a_array.length; index++) {
		var aEle = a_array[index];
		$(aEle).attr("target","_blank");
	}

	var AVID = "";
	//获取番号影片详情页的番号  例如：https://avmo.pw/cn/movie/5rbn 
	if($('.header').length ){
		AVID = $('.header')[0].nextElementSibling.textContent;
		debugger;
		console.log("番号输出:"+AVID);
		common.addAvImg(AVID,function ($img) {
			var divEle = $("div[class='col-md-3 info']")[0];
			if (divEle) {
				$(divEle.parentElement).append($img);
				$img.click(function(){
					$(this).toggleClass('min');
					if($(this).attr("class")){
						this.parentElement.parentElement.scrollIntoView();
					}
				});
				//$img.load(function() {
				//    console.log('load compeleted');
				//});
			}
			// http://www.javlibrary.com/cn/?v=javlilzo4e
			divEle = $("div[id='video_favorite_edit']")[0];
			if (divEle) {
				$img.attr("style","");
				$(divEle).after($img);
				$img.click(function(){
					$(this).toggleClass('min');
					if($(this).attr("class")){
						this.parentElement.parentElement.scrollIntoView();
					}
				});
			}

		});
	}


	// JAV列表 自动加载下一页 无限滚动加载
	const pagegen = fetchSync(location.href);
	var anchor = $('.pagination')[0];
	const mutex = new Lock();

	var $pages = $('div#waterfall div.item');
	var $pages2 = $('div.videos div.video');

	// javbus.com、avmo.pw、avso.pw
	if ($pages.length) {
		scrollInit($pages);
	}
	// javlibrary
	else if ($pages2.length) {
		anchor = $('.page_selector')[0];
		$pages2[0].parentElement.id = "waterfall";
		scrollInit($pages2);
	}
	//});
})();