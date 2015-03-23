/* ふりがなチェック */
function FuriganaCheck() {
   var str = document.iform.FuriganaText.value;
   if( str.match( /[^ぁ-んァ-ン　\s]+/ ) ) {
      alert("ふりがなは、「ひらがな」・「カタカナ」のみで入力して下さい。");
      return 1;
   }
   return 0;
}

/* 半角英文字チェック */
function AlphabetCheck() {
   var str = document.form2.cus_username.value;
   if( str.match( /[^A-Za-z\s.-]+/ ) ) {
      alert("英語名は、半角英文字のみで入力して下さい。");
      return 1;
   }
   return 0;
}

/* 半角数字チェック */
function NumberCheck() {
   var str = document.iform.AgeText.value;
   if( str.match( /[^0-9]+/ ) ) {
      alert("年齢は、半角数字のみで入力して下さい。");
      return 1;
   }
   return 0;
}

/* 全部チェック */
function AllCheck() {
   var check = 0;
   check += FuriganaCheck();
   check += AlphabetCheck();
   check += NumberCheck();
   if( check > 0 ) {
      return false;
   }
   return check;
}