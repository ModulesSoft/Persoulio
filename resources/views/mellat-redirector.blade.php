<html>
    <body>
        <script>
//			"https://bpm.shaparak.ir/pgwchannel/startpay.mellat"
        	var form = document.createElement("form");
        	form.setAttribute("method", "POST");
        	form.setAttribute("action", '{{route('mellatPage')}}');
        	form.setAttribute("target", "_self");

            var hiddenField = document.createElement("input");
        	hiddenField.setAttribute("name", "RefId");
        	hiddenField.setAttribute("value", "{{$refId}}");

			var csrf = document.createElement("input");
			csrf.setAttribute("name", "_token");
			csrf.setAttribute("value", "{{csrf_token()}}");

			var callBack = document.createElement("input");
			callBack.setAttribute("name", "callBack");
			callBack.setAttribute("value", "{{$callBack}}");

			var price = document.createElement("input");
			price.setAttribute("name", "price");
			price.setAttribute("value", "{{$price}}");

			form.appendChild(csrf);
			form.appendChild(price);
			form.appendChild(callBack);
            form.appendChild(hiddenField);

        	document.body.appendChild(form);
        	form.submit();
        	document.body.removeChild(form);
        </script>
    </body>
</html>
