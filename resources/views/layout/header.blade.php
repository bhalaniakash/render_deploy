<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .buttons-search {
            flex: 0 0 auto;
            width: auto;
            right: 0;
        }
    </style>
</head>
<body>
   <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end buttons-search">

        <form class="col-12 col-lg-auto mb-1 mb-lg-0 me-lg-1">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search" id="search-input">
        </form>

        <div class="text-end">
          <a href="{{ Route("login") }}">
          <button type="button" class="btn btn-outline-light me-2">Login</button></a>
          <a href="{{ Route("register") }}">
          <button type="button" class="btn btn-warning">Sign-up</button></a>
        </div>
      </div>
    </div>
  </header>
</body>
</html>