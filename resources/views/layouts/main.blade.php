<!doctype html>
<html>
  <head>
    <title>Faster</title>
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/css/style.css"/>
    @yield("head")
  </head>

  <body>
    <div class="top-bar">
      <div class="title-box">
        <span class="title-text" >Simple Blog</span>
      </div>

      <div class="topbar-right-content">
        <span>
          <a href="/">
            Posts
          </a>
        </span>
        <span>
          <a href="/login">
            Login
          </a>
        </span>
        <span>
          <a href="/register">
            Register
          </a>
        </span>
      </div>

    </div>
    <div class="container">
    @section("body")
    @show
    </div>

    @yield("script")

  </body>
</html>
