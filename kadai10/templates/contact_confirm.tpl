<!doctype html>
<html lang="ja">
  <head>
    <title>お問い合わせ</title>
    <style type="text/css">
      .max{
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
    <p>以下の内容でよろしいですか？</p>
    <form method="post" action="">
      <h2>お名前</h2>
      <p class="max">{$name|escape|nl2br}</p>

      <h2>ご連絡先(メールアドレス)</h2>
      <p class="max">{$mail|escape|nl2br}</p>

      <h2>お問合せ件名</h2>
      <p class="max">{$subject|escape|nl2br}</p>

      <h2>お問い合わせ内容＊</h2>
      <p class="max">{$content|escape|nl2br}</p>

      <div>
        <input id="submitbtn" type="submit" name="back" value="戻る"/>
        <input id="submitbtn" type="submit" name="next" value="送信"/>
      </div>
    </form>
  </body>
</html>
