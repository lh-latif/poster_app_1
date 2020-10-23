@extends("layouts/main")

@section("head")
  <script src="/js/quill.min.js"></script>
  <link type="text/css" rel="stylesheet" href="/css/quill.snow.css"/>
  <link type="text/css" rel="stylesheet" href="/css/quill.core.css"/>
@endsection

@section("body")
<div class="pt-5">
  <h1 class="pb-4">Post Baru</h1>
  <div>
    <div class="form-row">
      <div class="form-group col-12">
        <label>Judul</label>
        <input id="title" type="text" name="title" class="form-control display-3">
      </div>
    </div>

    <div class="editor ">
    </div>

    <button type="submit" id="save-btn" class="btn btn-primary mt-3">
      Simpan
    </button>

  </div>

  <!-- <form action="/account/add_post" method="POST">
    @csrf
    <label>Judul</label>
    <input type="text" name="title">
    <label>Konten</label>
    <textarea name="content"></textarea>
    <input type="submit">
  </form> -->

</div>
@endsection


@section("script")
  <script>
    var title = document.getElementById("title");
    var saveBtn = document.getElementById("save-btn");
    saveBtn.addEventListener("click",function() {
      console.log(editor.getContents());
      var data = new FormData();
      data.append("title",title.value);
      data.append("content",JSON.stringify(editor.getContents()));
      var req = new XMLHttpRequest();
      req.open("POST","/account/add_post");
      req.send(data);
    });
    var opt = {
      module: {
        toolbar: "#toolbar"
      },
      placeholder: "Tulis Post",
      theme: "snow"
    };
    var editor = new Quill(".editor",opt);

  </script>
@endsection
