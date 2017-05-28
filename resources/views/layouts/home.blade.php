<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>yiluohan1234</title>
    <meta name="keywords" content="yiluohan1234">
    <meta name="description" content="一个简单易用的mysql博客系统">

    <link rel="stylesheet" href="{{asset('resources/views/home/assets/plugins/bootstrap/css/bootstrap.min.css?ver=2.2')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('resources/views/home/assets/plugins/font-awesome/css/font-awesome.min.css?ver=2.2')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600&subset=latin,latin-ext">
    <link rel="stylesheet" href="{{asset('resources/views/home/css/style.css?ver=2.2')}}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('resources/views/home/css/customizer.css?ver=2.2')}}" type="text/css" media="all" />
    <link rel="alternate" type="application/rss+xml" title="欢迎使用GitBlog" href="/feed.xml" />

</head>

<body class="home blog wide">
    <div id="page" class="hfeed site">
        <!-- <a class="skip-link screen-reader-text" href="#content">Skip to content</a> -->
        <!--header start-->
        <header id="masthead" class="main-header" role="banner">
            <div class="container">
                <div class="row">
                    <div class="site-branding col-md-4">
                        <h1 class="site-title">
                            <a href="/" rel="home">yiluohan1234</a>
                        </h1>
                        <span class="site-description">一个自由程序的爱好者</span>
                    </div>
                    <!-- .site-branding --> </div>
            </div>
        </header>
        <!--header end-->
        <!--content start-->
        @yield('content')
        <div id="secondary" class="widget-area main-sidebar col-md-3" role="complementary">
            <aside class="widget widget_search sidebar-widget clearfix">
                <h3 class="widget-title">搜索</h3>
                <form class="search" action="/search" method="get">
                    <fieldset>
                        <div class="text">
                            <input name="keyword" id="keyword" type="text" placeholder="Search ..."/>
                            <button class="fa fa-search">Search</button>
                        </div>
                    </fieldset>
                </form>
            </aside>
            <aside class="widget widget_recent_entries sidebar-widget clearfix">
                <h3 class="widget-title">热门推荐</h3>
                <ul>
                    @foreach($hots as $p)
                    <li>
                        <a href="{{url('article/'.$p->art_id)}}">{{$p->art_title}}</a>
                    </li>
                    @endforeach
                </ul>
            </aside>
            <aside class="widget widget_categories sidebar-widget clearfix">
                <h3 class="widget-title">分类目录</h3>
                <ul>
                    @foreach($categorys as $p)
                    <li class="cat-item">
                        <a href="{{url('category/'.$p->cate_id)}}" >{{$p->cate_name}}</a>
                    </li>
                    @endforeach
                </ul>
            </aside>
            <aside class="widget widget_archive sidebar-widget clearfix">
                <h3 class="widget-title">文章归档</h3>
                <ul>
                    @foreach($months as $p)
                    <li>
                        <a href="{{url('achieve/'.$p)}}">{{$p}}</a>
                    </li>
                    @endforeach
                </ul>
            </aside>
            <!--标签1.0版本不做
                            <aside class="widget widget_tag_cloud sidebar-widget clearfix">
            <h3 class="widget-title">标签</h3>
            <div class="tagcloud">
                <a href="/tags/GitBlog.html"  title="GitBlog" >GitBlog</a>
            </div>
        </aside>
        -->
        <aside class="widget widget_text sidebar-widget clearfix">
            <h3 class="widget-title">介绍</h3>
            <div class="textwidget">
                <p>本博客由yiluohan1234搭建，欢迎你!</p>
            </div>
        </aside>
    </div>
    <!-- #secondary -->
</div>
<!-- .row -->
</div>
<!-- .container -->
</div>
<!-- .quest-row -->
</div>
<!--content start-->
<footer id="colophon" class="copyright quest-row" role="contentinfo">
<div class="container">
<div class="row">
<div class="col-md-6 copyright-text">
    <a href="https://github.com/yiluohan1234">powered by yiluohan1234</a>
</div>
<div class="col-md-6 social-icon-container clearfix">
    <ul></ul>
</div>
</div>
<!-- end row -->
</div>
<!-- end container -->
</footer>
</div>
<!-- #page -->
<a href="#0" class="cd-top"> <i class="fa fa-angle-up"></i>
</a>

<script type="text/javascript" src="{{asset('resources/views/home/assets/plugins/modernizr/modernizr.custom.js?ver=2.2')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/home/js/jquery/jquery.js?ver=1.11.2')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/home/js/jquery/jquery-migrate.min.js?ver=1.2.1')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/home/assets/plugins/bootstrap/js/bootstrap.min.js?ver=2.2')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/home/assets/plugins/wow/wow.js?ver=2.2')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/home/assets/plugins/colorbox/jquery.colorbox-min.js?ver=2.2')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/home/assets/js/quest.js?ver=2.2')}}"></script>

<link rel="stylesheet" href="//cdn.bootcss.com/highlight.js/8.6/styles/default.min.css">
<script src="//cdn.bootcss.com/highlight.js/8.6/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

<link rel="stylesheet" href="//cdn.bootcss.com/KaTeX/0.6.0/katex.min.css">
<script src="//cdn.bootcss.com/KaTeX/0.6.0/katex.min.js"></script>
<script src="//cdn.bootcss.com/KaTeX/0.6.0/contrib/auto-render.min.js"></script>
<script type="text/javascript">
        render_option = {
            delimiters: [
                // 段落模式 $$...$$ \[...\]
                {left: "$$", right: "$$", display: true},
                {left: "\\[", right: "\\]", display: true},
                // 行内模式 $...$ \(...\)
                {left: "$", right: "$", display: false},
                {left: "\\(", right: "\\)", display: false}
            ],
            ignoredTags: ["script", "noscript", "style", "textarea", "pre", "code"]
        }
        renderMathInElement(document.body, render_option);
    </script>

<script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});</script>
<script type="text/javascript" src="//cdn.bootcss.com/mathjax/2.5.3/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>

</body>
</html>