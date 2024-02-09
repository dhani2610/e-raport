# HALAMAN LOGIN

desc: Halaman Login
routes: /login
name: login
method: GET
  body :
    {
      Username: username (input:text)
      Password: password (input:password)
      Tapel: tapel_id (select)
    }


desc: P
routes: /login
name: login
method: POST
  response :
    {
      Username: username (input:text)
      Password: password (input:password)
      Tapel: tapel_id (select)
    }
