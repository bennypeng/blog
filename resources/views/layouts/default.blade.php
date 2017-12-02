<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '主页') - 专注互联网开发</title>
    <link rel="stylesheet" href="/css/app.css"/>
    <script type="text/javascript" src="/js/app.js"></script>
  </head>
  <body>
    <div class="container">
      <header class="navbar navbar-inverse navbar-fixed-top">
        <div class="row">
          <div class="col-md-4">
            <a id="logo" class="navbar-brand">BP BLOG</a>
          </div>
          <div class="col-md-4 col-md-offset-4">
            <nav>
              <ul class="nav navbar-nav navbar-left">
                <li><a href="/">首页</a></li>
                <li><a href="#">干货</a></li>
                <li><a href="/music">音乐</a></li>
                <li><a href="/help">帮助</a></li>
                <li><a href="/about">关于</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </header>
    </div>
    <div class="container">
      @yield('content')
    </div>
  </body>
</html>
