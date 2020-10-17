<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
    <style>

        .book {
            padding-top: 20px;
            background: #fff;
            width: 1000px;
            margin: 0 auto;
            margin-top: 50px;
            border: 1px solid #fff;
            border-width: 1px 0;
            height: 600px;
            background: #fff url(/wp-content/plugins/private-diary/admin/images/book_bg.jpg) repeat-y center 0;
            margin-bottom: 300px;
        }

        .textarea {
            padding: 20px;
            width: 100%;
        }

        .textarea textarea {
            width: 100%;
            margin: 0 auto;
            height: 470px;
        }

        .heatmap_cell {
            background: #d4dae1;
            border-radius: 2px;
            cursor: pointer;
        }

        .heatmap__grid {
            display: grid;
            width: 634px;
            height: 82px;
            grid-column-gap: 2px;
            grid-row-gap: 2px;
            grid-template-rows: repeat(7, 1fr);
            grid-template-columns: repeat(53, 1fr);
            grid-auto-flow: column;
        }

        .analytic {
            background: white;
            padding: 20px;
        }

        .years {
            padding-bottom: 20px;
        }
    </style>
</head>
<body style=" background: #ddd;">


<section class="book" id="app">
<div class="container">
    <div class="row">
        <input type="text" style="width: 100px" v-model="diaryPassword" >                <button @click="convertContent()" >sdfsd</button>

    </div>
</div>
    <div class="container">

        <div class="row">

            <div class="col-md-6">
                <div class="toolbar">
                    <div class="col-md-6">
                        {{diary.wather}}
                    </div>
                    <div class="col-md-6">
                        Date:{{diary.date}}
                    </div>
                </div>
                <div class="textarea">

                    {{content}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="toolbar">

                    <div class="row">


                        <div class="col-md-6">
                            <input type="date" @change="changeDate()" :value="diary.date">

                        </div>
                        <div class="col-md-6">
                            weather
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="textarea">
                        <textarea v-model="diary.content" name="" id="" cols="30" rows="10"></textarea>
                        <button @click="store()" class="btn btn-success" value="Submit">Submimt</button>

                    </div>

                </div>


            </div>
        </div>
    </div>

    <div class="container analytic">

        <div class="contributions">

            <div class="years">
                <button class="btn btn-success">2012</button>
                <button class="btn btn-success">2012</button>

            </div>
            <div class="heatmap__grid">
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
                <div class="heatmap_cell">

                </div>
            </div>

        </div>

    </div>
</section>


</body>
</html>
<script>


    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!',
            headmaps: [{date: '2020-01-02', num: 120}, {date: '2020-01-02', num: 120}],
            diary: {date: "", content: "", weather: 1},
            base64content:'',
            content:'',
            diaryPassword:"",

        },
        methods: {
            changeDate: function () {
                console.log("chanegdate");
            },
            store:function(){
              let basecontent=Secret_Key(this.diary.content,this.diaryPassword,'E');
              this.base64content=basecontent;
                console.log(this.base64content);

                this.created(this.base64content,this.diary.date,this.diary.weather)

              //那么
             // var pass2=Secret_Key(this.base64content,diaryPassword,'D');
           //  console.log(this.base64content);
           //     console.log(pass2);

            },
            convertContent:function(){
                var content=Secret_Key("6106f776da8e54e7368b992249aada550b9ff28c5a9c07a8829bfb7b95af7997df3a7761cc5014abf13f57adee93d81f927c1e44dd0766aa02e4763938c6fc47ee633f20128d9b8734293505ce6d743c33d9c30485c6116b3c8291a438227f1cecf639a4c43510c63a4dbc52902bbd438d7c744b4bfd1c2c2abfae793ab6ccf4016eb20626bc21d417d1b1d6c1793221f51452ebb48edee8d589d291f4881a4f07449be2b0a66d79493aec40b9f7f1c45e6ee664f6fe4638a6bcff2ab1e6ee7589b0ae0355ac1378742cf31943a2f291ef12d158e8983817715a3f92e6e990ff693164903d3f335e20e700f14c8ef02e2ca29a847ec1a7630eed0f0ea8d02ae93509aef5f752e4212137617abe88a6e3e7297deffa4d3b49689d995a00000064e76aa8ede900a3875eb0849dae4dd9643a581f1c4d6febb812ba05072deaf004e6dea57d0f975a266b286c72add72fd09983dc99c75105679c302baba84be92f19b35cefd0aab0458f864f34ca9e846fa439177ceac9bdb7b10c9db2f73253fe3fa6cc86e3117b6f8a666951462fec84d6b7787aaaf34a52d354720d2add1bb09515b41041990721a932a8a7215645d7794ccf2571ea8a4a8f8a465a9f78efbe70504aec9e2b35b7477030b1cacea614b4aabf7a224f85ab136c9dc3ab92c5ced3ca741541885c0073e13271db7c0190e146cab86a9da4489274cf6ce73c73a9b02db6ca8f65c1719355a8e254febeb9f7a0a6ea6ddac16adff2b13bd689c370938e204dafcb79d3048c008bc9a627fb29725eacda27f175ac8e8a221b77ee9c01b34cbb9bfe4c5943eae23205ddd65eb7dfb5a70c9616be990be2b0e0c120d8f1d1984664792a6bbfb1efb401f03588616baaf72756a288c7126407551cff5b6c7363f589e1019803c4fd4e0f9f318fc99c1835bc7a882ac9a0e0a6b528b13c5504b16733a4bf0c0f195d876f529f15191e3c36de40330e38901776b4bd45c41f84d98e1d10265ea07b465639f0902d3366aa174c43eed76c5630428ce283943562396afeff17f22f81f72455491711478ca365ad029c233927f9657b8a01bcc4d5434c4c60cda923649edf73b1521c0d97134fae5354479e404fe3decc2d3e4c5185f2937580640493f52b5efd1c749a681bb27e0de5f6ac97fbeb9f7e5531b9decb09ea84c1c4b86f669dc38046eab4c8a7e498a79afd970813c7b0236bf0d8c247e8cf9d9e45a2e800b0bc25db30a8cc5e6cf2daec1a8579f20a56b217a36fcec4710c25454889d4edd1153ff0334ba797ebb8df17fc3d6aa33f7f926ec01b2a205eebe73470c3d657e6544a34e0918c85fd2abf95783966d09e03fb43704d9ca603f02420ca2af07d5e2f8a0148dbf1719a8cc68304f886166f3fcfad202418990ad1b5310336be5b8dc317b5882d92ce53c7b53c8c87763938bb7953a3852559bb442cfb743d125753551bcaa02298fa9b1528cec5575af53203751b61ef96eff84bf46d7215d0444c3b3975529d19711aa4bf07f66c37153fcd5feee054b6d49a64acffa0906e831204d02d4be325abf436d7bcf5e9a3860e12234f0aaaf607a38d0b94aae3477ceba88fc2cc8b51c8878fb477b864b5f3be10dd28d5cc5eb744b897bc0522c0b208126d52ae3f848f66846dbc1f483bf8fc2f82b70c9468d1c60ce65e786b2abb284091e88399e9a0f7e50965b6b2993f2cbd780c22b4f9c91ccc1504e36dfcc120fdd973a058f75c7c42ff74d30a66c305a8a25b8dfb12325cc5c5dbe0e211bdd0c320f11168c66f04833c5ffe5478aa78a952bb8e2149502aec5369cecb19665f2d74575ca67abef0b5c1c8188aea6a98c07fab5a34044c6590812e65cc896d00c24ef2e1e17b4050ac2975230e3dc83c502b19eacce08efcfa72e4bd494983ea4b88482d72402979a99dd28d4f05cb79c380a9e705fef72105508678e6461ad1f34fc7b75847bd587c7f593337dae718f4c8dd32cae93c15fa4679a16ec4c4cf49bb03ba250516310203e199",this.diaryPassword,'D');
                this.content=content;

            },

            created : async(content,date,weather) => {
                console.log('start');
                //,date:this.diary.date,weather:this.diary.weather
                const diary = { content:content,date:date,weather:weather };
                console.log(diary);
                const response =     await axios.post("/wp-json/private_diary/v1/store", diary);
                this.articleId = response.data.id;
                console.log('getid',response.data);
            },
        }
    })


    /**
     *
     *  Base64 encode / decode
     *  http://www.webtoolkit.info
     *
     **/
    var Base64 = {

        // private property
        _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="

        // public method for encoding
        , encode: function (input)
        {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;

            input = Base64._utf8_encode(input);

            while (i < input.length)
            {
                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);

                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;

                if (isNaN(chr2))
                {
                    enc3 = enc4 = 64;
                }
                else if (isNaN(chr3))
                {
                    enc4 = 64;
                }

                output = output +
                    this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                    this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
            } // Whend

            return output;
        } // End Function encode


        // public method for decoding
        ,decode: function (input)
        {
            var output = "";
            var chr1, chr2, chr3;
            var enc1, enc2, enc3, enc4;
            var i = 0;

            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
            while (i < input.length)
            {
                enc1 = this._keyStr.indexOf(input.charAt(i++));
                enc2 = this._keyStr.indexOf(input.charAt(i++));
                enc3 = this._keyStr.indexOf(input.charAt(i++));
                enc4 = this._keyStr.indexOf(input.charAt(i++));

                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;

                output = output + String.fromCharCode(chr1);

                if (enc3 != 64)
                {
                    output = output + String.fromCharCode(chr2);
                }

                if (enc4 != 64)
                {
                    output = output + String.fromCharCode(chr3);
                }

            } // Whend

            output = Base64._utf8_decode(output);

            return output;
        } // End Function decode


        // private method for UTF-8 encoding
        ,_utf8_encode: function (string)
        {
            var utftext = "";
            string = string.replace(/\r\n/g, "\n");

            for (var n = 0; n < string.length; n++)
            {
                var c = string.charCodeAt(n);

                if (c < 128)
                {
                    utftext += String.fromCharCode(c);
                }
                else if ((c > 127) && (c < 2048))
                {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
                else
                {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }

            } // Next n

            return utftext;
        } // End Function _utf8_encode

        // private method for UTF-8 decoding
        ,_utf8_decode: function (utftext)
        {
            var string = "";
            var i = 0;
            var c, c1, c2, c3;
            c = c1 = c2 = 0;

            while (i < utftext.length)
            {
                c = utftext.charCodeAt(i);

                if (c < 128)
                {
                    string += String.fromCharCode(c);
                    i++;
                }
                else if ((c > 191) && (c < 224))
                {
                    c2 = utftext.charCodeAt(i + 1);
                    string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                    i += 2;
                }
                else
                {
                    c2 = utftext.charCodeAt(i + 1);
                    c3 = utftext.charCodeAt(i + 2);
                    string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    i += 3;
                }

            } // Whend

            return string;
        } // End Function _utf8_decode

    }

    /**
     * JS字符串加密和解密
     * @date:    2018年06月07日 上午10:03:41
     * @author   Senao
     * @param    {[string]} [str] [需要加密/解密的字符串（包括中文）]
     * @param    {[string]} [pwd] [密码]
     * @param    {[string]} [type] [类型：E = 加密 、D = 解密]
     * @return   {[string]}
     */
    function Secret_Key(str,pwd,type) {

        var b = Base64; //需要加载一个Base64.js文件 可以上网自行下载
        if(type=='E'){   //加密
            str = b.encode(str);//Base64加密
            var prand = "";
            for(var i=0; i<pwd.length; i++) {
                prand += pwd.charCodeAt(i).toString();
            }
            var sPos = Math.floor(prand.length / 5);
            var mult = parseInt(prand.charAt(sPos) + prand.charAt(sPos*2) + prand.charAt(sPos*3) + prand.charAt(sPos*4) + prand.charAt(sPos*5));
            var incr = Math.ceil(pwd.length / 2);
            var modu = Math.pow(2, 31) - 1;
            if(mult < 2) {
                alert("Please choose a more complex or longer password.");
                return null;
            }
            var salt = Math.round(Math.random() * 1000000000) % 100000000;
            prand += salt;
            while(prand.length > 10) {
                prand = (parseInt(prand.substring(0, 10)) + parseInt(prand.substring(10, prand.length))).toString();
            }
            prand = (mult * prand + incr) % modu;
            var enc_chr = "";
            var enc_str = "";
            for(var i=0; i<str.length; i++) {
                enc_chr = parseInt(str.charCodeAt(i) ^ Math.floor((prand / modu) * 255));
                if(enc_chr < 16) {
                    enc_str += "0" + enc_chr.toString(16);
                } else enc_str += enc_chr.toString(16);
                prand = (mult * prand + incr) % modu;
            }
            salt = salt.toString(16);
            while(salt.length < 8)salt = "0" + salt;
            enc_str += salt;
            return enc_str;
        }
        if(type=='D'){  //解密
            var prand = "";
            for(var i=0; i<pwd.length; i++) {
                prand += pwd.charCodeAt(i).toString();
            }
            var sPos = Math.floor(prand.length / 5);
            var mult = parseInt(prand.charAt(sPos) + prand.charAt(sPos*2) + prand.charAt(sPos*3) + prand.charAt(sPos*4) + prand.charAt(sPos*5));
            var incr = Math.round(pwd.length / 2);
            var modu = Math.pow(2, 31) - 1;
            var salt = parseInt(str.substring(str.length - 8, str.length), 16);
            str = str.substring(0, str.length - 8);
            prand += salt;
            while(prand.length > 10) {
                prand = (parseInt(prand.substring(0, 10)) + parseInt(prand.substring(10, prand.length))).toString();
            }
            prand = (mult * prand + incr) % modu;
            var enc_chr = "";
            var enc_str = "";
            for(var i=0; i<str.length; i+=2) {
                enc_chr = parseInt(parseInt(str.substring(i, i+2), 16) ^ Math.floor((prand / modu) * 255));
                enc_str += String.fromCharCode(enc_chr);
                prand = (mult * prand + incr) % modu;
            }
            return b.decode(enc_str);
        }
    }

</script>