<!doctype html>
<html lang="ja">
  <head>
    <title>お問い合わせ</title>
    <style type="text/css">
      .max{
        width:90%;
        margin:0 20px;
      }
      .center{
        text-align:center;
      }
      #submitbtn{
        margin:10px;
        padding:5px 10px;
      }
    </style>
  </head>
  <body>
    <form method="post" action="./contact_confirm.php">
      <label><h2>お名前＊</h2></label>
      <input class="max" type="text" name="name"/></br>

      <label><h2>ご連絡先(メールアドレス)</h2></label>
      <input class="max" type="text" name="mail"/></br>

      <label><h2>お問合せ件名</h2></label>
      <input class="max" type="text" name="subject"/></br>

      <label><h2>お問い合わせ内容＊</h2></label>
      <textarea style="width:90%; height:60px; margin:0 20px;" type="textbox" name="content"></textarea>

      </br>
      <div class="center"><input id="submitbtn" type="submit" value="確認画面へ"/></div>
    </form>
  <a href="./index.html">トップページ</a>
  </body>
</html>
