<script>
    var $=jQuery;
    var csrfToken= $('meta[name="csrf-token"]').attr('content');

    window.Laravel = {!! json_encode([
        'user' => auth()->check() ? auth()->user()->id : null,
    ]) !!};

    $('#left_bar_collapse_btn').on('click',function(){
        setTimeout(function () {
            $('.select2').css('width','100%');
            $('.select-tag').css('width','100%');
            if($.fn.dataTable!==undefined) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            }
        },300);
    });

    // $('input[type=number]').on('mousewheel',function(e){ console.log('OK'); $(this).blur(); });

    $(window).on('load',function(){
        $('.select2').select2();
        $('.select2-tag').select2({
            'tags':true
        });
    });

    function percent(total,percent){
        let result= (total/100)*percent;
        return result;
    }

    function percent_reverse(total,amount){
        let result= (100/total)*amount;
        return result;
    }


    function readURL(input,imgId) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#'+imgId).attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearImg(deleteBtn,deleteFlag,input,imgId,defaultImg) {
        $('#'+deleteBtn).css('display','none');
        let deleteFlagObj= $('#'+deleteFlag);
        deleteFlagObj.removeAttr('disabled');
        deleteFlagObj.val(1);
        $('#'+input).val('');
        $('#'+imgId).attr('src', defaultImg);
    }

    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault();
        })
    });
    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('wheel.disableScroll');
    });

    function get_day_by_date(input_date,bn=false){
        if(input_date!==''){
            input_date=input_date.split('-');
            input_date=input_date[1]+'-'+input_date[2]+'-'+input_date[0];
            var d = new Date(input_date);
            var n = d.getDay();
            let days=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','রবি','সোম','মঙ্গল','বুধ','বৃহস্পতি','শুক্র','শনি'];
            if(bn){
                return days[n+7];
            }
            else{
                return days[n];
            }
        }
        else
        {
            return '';
        }
    }

    function check_unknown(e,id){
       if(e.checked)
       {
           clearThis(id);
           $('#'+id).attr('readonly','readonly');
       }
       else
       {
           $('#'+id).removeAttr('readonly');
       }
    }

    function clearThis(id) {
        $('#'+id).val('');
    }

    function printDiv(divId,guardHtml=false){
        var content;
        if(guardHtml)
        {
             content = document.getElementById(divId).innerText;
        }
        else
        {
             content = document.getElementById(divId).innerHTML;
        }

        var mywindow = window.open('', 'Print', 'height=600,width=1024');

        mywindow.document.write('<html lang="bn" onload="window.close();"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge"><title>Print</title>' + '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="keywords" content="পুলিশ ট্রেনিং বাজেট Admin." /><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"><link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet"><style>body {font-family: "SolaimanLipi", Arial, sans-serif !important;}\n' +
            '    th,td{\n' +
            '        font-size: 13px;\n' +
            '        padding-top:.5rem !important;\n' +
            '        padding-bottom:.5rem !important;\n' +
            '        @page {size:auto;}\n' +
            '    }' +
            ' @media print {@page {size: auto;}.no-print {display: none;} .report-content .table th, .report-content .table td{border:1px solid black !important; color:black !important;}</style>');
        mywindow.document.write('</head><body onload="window.print();">');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus()
        return true;
    }

    function nullCheck(value) {
        if(value==null){
            return '';
        }
        else
        {
            return value;
        }
    }

    function isEmpty(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
    }

    let currencyFormat = function(value) {
        value = parseFloat(value).toFixed(2);
        return value; //for chaining
    };

    function date_to_number(date)
    {
        let arr = date.split('-');
        let str= arr[0]+arr[1]+arr[2];
        return parseInt(str);
    }

    function today_datetime() {
        var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();

        return yyyy+'-'+mm+'-'+dd;
    }

    function en_Numbers(input) {
        var numbers = {
            '০':0,
            '১':1,
            '২':2,
            '৩':3,
            '৪':4,
            '৫':5,
            '৬':6,
            '৭':7,
            '৮':8,
            '৯':9
        };
        var output = [];
        for (var i = 0; i < input.length; ++i) {
            if (numbers.hasOwnProperty(input[i])) {
                output.push(numbers[input[i]]);
            } else {
                output.push(input[i]);
            }
        }
        return output.join('');
    }

    function bn_Numbers(input) {
        var numbers = {
            0:'০',
            1:'১',
            2:'২',
            3:'৩',
            4:'৪',
            5:'৫',
            6:'৬',
            7:'৭',
            8:'৮',
            9:'৯'
        };
        var output = [];
        for (var i = 0; i < input.length; ++i) {
            if (numbers.hasOwnProperty(input[i])) {
                output.push(numbers[input[i]]);
            } else {
                output.push(input[i]);
            }
        }
        return output.join('');
    }

    function showMore(ele){
        $(ele).closest('.show-less-div').css('display','none');
        $(ele).closest('.show-less-div').siblings('.show-more-div').css('display','block');
    }
    function showLess(ele){
        $(ele).closest('.show-more-div').css('display','none');
        $(ele).closest('.show-more-div').siblings('.show-less-div').css('display','block');
    }

    function resetForm(id,header,body,okMessage='From reset successful.',cancelMessage=null) {
        alertify.confirm('<strong>'+header+'</strong>',body,
            function(){
                document.getElementById(id).reset();
                if(okMessage){
                    alertify.success(okMessage);
                }
            },
            function(){
                if(cancelMessage){
                    alertify.success(cancelMessage);
                }
            });
    }

    function file_check(e,regex,$message,img_id=null,default_image=null,callback=null){
        if (e.value.match(regex)) {
        } else {
            e.value = "";
            if(callback!==null){
                callback(img_id,default_image);
            }
            alertify.notify($message, 'error', 5, function(){  });
        }
    }

    $('form').on('submit',function(){
        $(":submit").attr('disabled','disabled');
        let btnHtml=$(":submit").html();
        $(":submit").html('Processing...');
        setTimeout(function(){
            $(":submit").removeAttr('disabled');
            $(":submit").html(btnHtml);
            $(":submit[value='submitForm']").html('<small>সাবমিট</small>');
            $(":submit[value='fastSubmitForm']").html('<small>দ্রুত সাবমিট</small>');
        },2000)
    });

    function init_datepicker(id,maxDate='2040-12-31',minDate='1900-01-01'){
        let from=minDate.split("-");
        let to=maxDate.split("-");
        from=parseInt(from[0]);
        to=parseInt(to[0]);
        new Pikaday({
            field: $('#'+id)[0] ,
            firstDay: 1,
            format: 'YYYY-MM-DD',
            toString: function (date, format) {
                var day   = date.getDate();
                var month = date.getMonth() + 1;
                var year  = date.getFullYear();

                var yyyy = year;
                var mm   = ((month > 9) ? '' : '0') + month;
                var dd   = ((day > 9)   ? '' : '0') + day;

                return yyyy + '-' + mm + '-' + dd;
            },
            position: 'bottom right',
            minDate: new Date(minDate),
            maxDate: new Date(maxDate),
            yearRange: [from, to]
        });
    }

    function taka_format(num,toFixed=2)
    {
        var minus="";
        if(num<0)
        {
            num=Math.abs(num);
            minus="-";
        }
        let strNum;
        if(toFixed!=null&&num>=0)
        {
            num=num.toString();
            strNum = Number(num).toFixed(toFixed);
        }
        else
        {
            strNum=num;
            strNum=String(num);
        }
        //let strNum=String(floatNum);
        let res=strNum.split(".");
        let firstres=[];
        let j=0;
        let c=0;
        for(let i=res[0].length-1; i>=0; i--)
        {
            firstres[j]=res[0][i];
            j++;
            if(j===3&&i!==0)
            {
                firstres[j]=",";
                j++;
            }
            else if(j>4&&j<11&&c===1&&i!==0){
                firstres[j]=",";
                j++;
                c=-1;
            }

            if(j>4)
            {
                c++;
            }
        }
        let first_half=firstres.reverse();
        if(res[1]===undefined || res[1]==='00')
        {
            return minus+first_half.join("");
        }
        else{
            return minus+first_half.join("")+'.'+res[1];
        }
    }

    function groupArrayOfObjects(list, key) {
        return list.reduce(function(rv, x) {
            (rv[x[key]] = rv[x[key]] || []).push(x);
            return rv;
        }, {});
    }

    function onlyUnique(value, index, self) {
        return self.indexOf(value) === index;
    }

    function arrayUnique(arr){
        return arr.filter(onlyUnique);
    }

    function takaToFloat(str,lang='en'){
        if(lang!=='en'){
            str=en_Numbers(str);
        }
        str=str.replaceAll(',','');
        return parseFloat(str);
    }

    //bangla_num_to_word


    var num_to_bd ={1:'এক',2:'দুই',3:'তিন',4:'চার',5:'পাঁচ',6:'ছয়',7:'সাত',8:'আট', 9:'নয়',10:'দশ',11:'এগার',12:'বার',13:'তের',14:'চৌদ্দ',15:'পনের',
        16:'ষোল',17:'সতের',18:'আঠার',19:'ঊনিশ',20:'বিশ',21:'একুশ',22:'বাইশ',23:'তেইশ',24:'চব্বিশ',25:'পঁচিশ',26:'ছাব্বিশ',27:'সাতাশ',28:'আঠাশ',29:'ঊনত্রিশ',30:'ত্রিশ',
        31:'একত্রিশ',32:'বত্রিশ',33:'তেত্রিশ',34:'চৌত্রিশ',35:'পঁয়ত্রিশ',36:'ছত্রিশ',37:'সাঁইত্রিশ',38:'আটত্রিশ',39:'ঊনচল্লিশ',40:'চল্লিশ',41:'একচল্লিশ',42:'বিয়াল্লিশ',43:'তেতাল্লিশ',44:'চুয়াল্লিশ',45:'পঁয়তাল্লিশ',
        46:'ছেচল্লিশ',47:'সাতচল্লিশ',48:'আটচল্লিশ',49:'ঊনপঞ্চাশ',50:'পঞ্চাশ',51:'একান্ন',52:'বায়ান্ন',53:'তিপ্পান্ন',54:'চুয়ান্ন',55:'পঞ্চান্ন',56:'ছাপ্পান্ন',57:'সাতান্ন',58:'আটান্ন',59:'ঊনষাট',60:'ষাট',
        61:'একষট্টি',62:'বাষট্টি',63:'তেষট্টি',64:'চৌষট্টি',65:'পঁয়ষট্টি',66:'ছেষট্টি',67:'সাতষট্টি',68:'আটষট্টি',69:'ঊনসত্তর',70:'সত্তর',71:'একাত্তর',72:'বাহাত্তর',73:'তিয়াত্তর',74:'চুয়াত্তর',75:'পঁচাত্তর',
        76:'ছিয়াত্তর',77:'সাতাত্তর',78:'আটাত্তর',79:'ঊনআশি',80:'আশি',81:'একাশি',82:'বিরাশি',83:'তিরাশি',84:'চুরাশি',85:'পঁচাশি',86:'ছিয়াশি',87:'সাতাশি',88:'আটাশি',89:'ঊননব্বই',90:'নব্বই',
        91:'একানব্বই',92:'বিরানব্বই',93:'তিরানব্বই',94:'চুরানব্বই',95:'পঁচানব্বই',96:'ছিয়ানব্বই',97:'সাতানব্বই',98:'আটানব্বই',99:'নিরানব্বই'};
    var num_to_bn_decimal = {0:'শূন্য ',1:'এক ',2:'দুই ',3:'তিন ',4:'চার ',5:'পাঁচ ',6:'ছয় ',7:'সাত ',8:'আট ', 9:'নয় '};
    var hundreds = 'শত';
    var thousands = 'হাজার';
    var lakhs = 'লক্ষ';
    var crores = 'কোটি';

    function underHundreda(num){
        let number = (num === 0)?'': numToBn(num);
        return number;
    }

    function hundreda(num){
        let a = parseInt(num/100);
        let b = num%100;
        let hundred = (a === 0)?'': numToBn(a)+' '+hundreds;
        return (hundred!=='')?(hundred+' '+underHundreda(b)):underHundreda(b);
    }

    function thousanda(num){
        let a = parseInt(num/1000);
        let b = num%1000;
        let thousand = (a === 0)?'': numToBn(a)+' '+thousands;
        return (thousand!=='')?(thousand+' '+hundreda(b)):hundreda(b);
    }

    function lakha(num){
        let a = parseInt(num/100000);
        let b = num%100000;
        let lakh = (a === 0)?'': numToBn(a)+' '+lakhs;
        return (lakh!=='')?(lakh+' '+thousanda(b)):thousanda(b);
    }

    function crorea(num){
        let a = parseInt(num/10000000);
        let b = num%10000000;
        let more_than_core = (a>99)?lakha(a):numToBn(a);
        return (more_than_core!=='')?(more_than_core+' '+crores+' '+lakha(b)):lakha(b);
    }

    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function is_float( mixed_var ) {
        return parseFloat(mixed_var * 1) != parseInt(mixed_var * 1);
    }

    function strtr(number,numArr){
        return numArr[number];
    }


    function numToWord(number){
        if (!isNumeric(number)) return 'Not a Number';

        if(is_float(number)){
            number=number.toString();
            dot = number.split(".");
            return numberSelector(parseInt(dot[0]))+' দশমিক '+numToBnDecimal(dot[1]);
        }else{
            return numberSelector(number);
        }

    }
    function numToBn(number){
        $word = strtr(number,num_to_bd);
        return $word;
    }
    function numToBnDecimal(number){
        var output = [];
        for (var i = 0; i < number.length; ++i) {
            if (num_to_bn_decimal.hasOwnProperty(number[i])) {
                output.push(num_to_bn_decimal[number[i]]);
            } else {
                output.push(number[i]);
            }
        }
        return output.join('');
    }

    function numberSelector(number){
        if(number > 9999999){
            return crorea(number);
        }else if(number > 99999){
            return lakha(number);
        }else if(number > 999){
            return thousanda(number);
        }else if(number > 99){
            return hundreda(number);
        }else{
            return underHundreda(number);
        }
    }

    function amountToTakaWithWordInBn(amount,toFixed=2){
        amount=parseFloat(amount);
        amount= amount.toFixed(toFixed);
        amount=parseFloat(amount);
        return bn_Numbers(taka_format(amount,toFixed))+'/-( মাত্র '+numToWord(amount)+')'
    }

</script>
