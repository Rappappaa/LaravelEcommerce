@extends('layouts.master')
@section('content')
    <script type="text/javascript">
        function populate(s1,s2){
            let city = document.getElementById(s1);
            let district = document.getElementById(s2);
            district.innerHTML = "";
            let optionArray;
            if(city.value === "1"){ optionArray = ["1|Seyhan", "2|Ceyhan", "3|Feke", "4|Karaisalı", "5|Karataş", "6|Kozan", "7|Pozantı", "8|Saimbeyli", "9|Tufanbeyli", "10|Yumurtalık", "11|Yüreğir", "12|Aladağ", "13|İmamoğlu", "14|Sarıçam", "15|Çukurova"];}
            if(city.value === "2"){ optionArray = ["16|Adıyaman Merkez", "17|Besni", "18|Çelikhan", "19|Gerger", "20|Gölbaşı / Adıyaman", "21|Kahta", "22|Samsat", "23|Sincik", "24|Tut"]; }
            if(city.value === "3"){ optionArray = ["25|Afyonkarahisar Merkez", "26|Bolvadin", "27|Çay", "28|Dazkırı", "29|Dinar", "30|Emirdağ", "31|İhsaniye", "32|Sandıklı", "33|Sinanpaşa", "34|Sultandağı", "35|Şuhut", "36|Başmakçı", "37|Bayat / Afyonkarahisar", "38|İscehisar", "39|Çobanlar", "40|Evciler", "41|Hocalar", "42|Kızılören"]; }
            if(city.value === "4"){ optionArray = ["43|Ağrı Merkez", "44|Diyadin", "45|Doğubayazıt", "46|Eleşkirt", "47|Hamur", "48|Patnos", "49|Taşlıçay", "50|Tutak"]; }
            if(city.value === "5"){ optionArray = ["51|Amasya Merkez", "52|Göynücek", "53|Gümüşhacıköy", "54|Merzifon", "55|Suluova", "56|Taşova", "57|Hamamözü"]; }
            if(city.value === "6"){ optionArray = ["58|Altındağ", "59|Ayaş", "60|Bala", "61|Beypazarı", "62|Çamlıdere", "63|Çankaya", "64|Çubuk", "65|Elmadağ", "66|Güdül", "67|Haymana", "68|Kalecik", "69|Kızılcahamam", "70|Nallıhan", "71|Polatlı", "72|Şereflikoçhisar", "73|Yenimahalle", "74|Gölbaşı / Ankara", "75|Keçiören", "76|Mamak", "77|Sincan", "78|Kazan", "79|Akyurt", "80|Etimesgut", "81|Evren", "82|Pursaklar"]; }
            if(city.value === "7"){ optionArray = ["83|Akseki", "84|Alanya", "85|Elmalı", "86|Finike", "87|Gazipaşa", "88|Gündoğmuş", "89|Kaş", "90|Korkuteli", "91|Kumluca", "92|Manavgat", "93|Serik", "94|Demre", "95|İbradı", "96|Kemer / Antalya", "97|Aksu / Antalya", "98|Döşemealtı", "99|Kepez", "100|Konyaaltı", "101|Muratpaşa"]; }
            if(city.value === "8"){ optionArray = ["102|Ardanuç", "103|Arhavi", "104|Artvin Merkez", "105|Borçka", "106|Hopa", "107|Şavşat", "108|Yusufeli", "109|Murgul"]; }
            if(city.value === "9"){ optionArray = ["110|Bozdoğan", "111|Çine", "112|Germencik", "113|Karacasu", "114|Koçarlı", "115|Kuşadası", "116|Kuyucak", "117|Nazilli", "118|Söke", "119|Sultanhisar", "120|Yenipazar / Aydın", "121|Buharkent", "122|İncirliova", "123|Karpuzlu", "124|Köşk", "125|Didim", "126|Efeler"]; }
            if(city.value === "10"){ optionArray = ["127|Ayvalık", "128|Balya", "129|Bandırma", "130|Bigadiç", "131|Burhaniye", "132|Dursunbey", "133|Edremit / Balıkesir", "134|Erdek", "135|Gönen / Balıkesir", "136|Havran", "137|İvrindi", "138|Kepsut", "139|Manyas", "140|Savaştepe", "141|Sındırgı", "142|Susurluk", "143|Marmara", "144|Gömeç", "145|Altıeylül", "146|Karesi"]; }
            if(city.value === "11"){ optionArray = ["147|Bilecik Merkez", "148|Bozüyük", "149|Gölpazarı", "150|Osmaneli", "151|Pazaryeri", "152|Söğüt", "153|Yenipazar / Bilecik", "154|İnhisar"]; }
            if(city.value === "12"){ optionArray = ["155|Bingöl Merkez", "156|Genç", "157|Karlıova", "158|Kiğı", "159|Solhan", "160|Adaklı", "161|Yayladere", "162|Yedisu"]; }
            if(city.value === "13"){ optionArray = ["163|Adilcevaz", "164|Ahlat", "165|Bitlis Merkez", "166|Hizan", "167|Mutki", "168|Tatvan", "169|Güroymak"]; }
            if(city.value === "14"){ optionArray = ["170|Bolu Merkez", "171|Gerede", "172|Göynük", "173|Kıbrıscık", "174|Mengen", "175|Mudurnu", "176|Seben", "177|Dörtdivan", "178|Yeniçağa"]; }
            if(city.value === "15"){ optionArray = ["179|Ağlasun", "180|Bucak", "181|Burdur Merkez", "182|Gölhisar", "183|Tefenni", "184|Yeşilova", "185|Karamanlı", "186|Kemer / Burdur", "187|Altınyayla / Burdur", "188|Çavdır", "189|Çeltikçi"]; }
            if(city.value === "16"){ optionArray = ["190|Gemlik", "191|İnegöl", "192|İznik", "193|Karacabey", "194|Keles", "195|Mudanya", "196|Mustafakemalpaşa", "197|Orhaneli", "198|Orhangazi", "199|Yenişehir / Bursa", "200|Büyükorhan", "201|Harmancık", "202|Nilüfer", "203|Osmangazi", "204|Yıldırım", "205|Gürsu", "206|Kestel"]; }
            if(city.value === "17"){ optionArray = ["207|Ayvacık / Çanakkale", "208|Bayramiç", "209|Biga", "210|Bozcaada", "211|Çan", "212|Çanakkale Merkez", "213|Eceabat", "214|Ezine", "215|Gelibolu", "216|Gökçeada", "217|Lapseki","218|Yenice / Çanakkale"]; }
            if(city.value === "18"){ optionArray = ["219|Çankırı Merkez", "220|Çerkeş", "221|Eldivan", "222|Ilgaz", "223|Kurşunlu", "224|Orta", "225|Şabanözü", "226|Yapraklı", "227|Atkaracalar", "228|Kızılırmak", "229|Bayramören", "230|Korgun"]; }
            if(city.value === "19"){ optionArray = ["231|Alaca", "232|Bayat / Çorum", "233|Çorum Merkez", "234|İskilip", "235|Kargı", "236|Mecitözü", "237|Ortaköy / Çorum", "238|Osmancık", "239|Sungurlu", "240|Boğazkale", "241|Uğurludağ", "242|Dodurga", "243|Laçin", "244|Oğuzlar"]; }
            if(city.value === "20"){ optionArray = ["245|Acıpayam", "246|Buldan", "247|Çal", "248|Çameli", "249|Çardak", "250|Çivril", "251|Güney", "252|Kale / Denizli", "253|Sarayköy", "254|Tavas", "255|Babadağ", "256|Bekilli", "257|Honaz", "258|Serinhisar", "259|Pamukkale", "260|Baklan", "261|Beyağaç", "262|Bozkurt / Denizli", "263|Merkezefendi"]; }
            if(city.value === "21"){ optionArray = ["264|Bismil", "265|Çermik", "266|Çınar", "267|Çüngüş", "268|Dicle", "269|Ergani", "270|Hani", "271|Hazro", "272|Kulp", "273|Lice", "274|Silvan", "275|Eğil", "276|Kocaköy", "277|Bağlar", "278|Kayapınar", "279|Sur", "280|Yenişehir / Diyarbakır"]; }
            if(city.value === "22"){ optionArray = ["281|Edirne Merkez", "282|Enez", "283|Havsa", "284|İpsala", "285|Keşan", "286|Lalapaşa", "287|Meriç", "288|Uzunköprü", "289|Süloğlu"]; }
            if(city.value === "23"){ optionArray = ["290|Ağın", "291|Baskil", "292|Elazığ Merkez", "293|Karakoçan", "294|Keban", "295|Maden", "296|Palu", "297|Sivrice", "298|Arıcak", "299|Kovancılar", "300|Alacakaya"]; }
            if(city.value === "24"){ optionArray = ["301|Çayırlı", "302|Erzincan Merkez", "303|İliç", "304|Kemah", "305|Kemaliye", "306|Refahiye", "307|Tercan", "308|Üzümlü", "309|Otlukbeli"]; }
            if(city.value === "25"){ optionArray = ["310|Aşkale", "311|Çat", "312|Hınıs", "313|Horasan", "314|İspir", "315|Karayazı", "316|Narman", "317|Oltu", "318|Olur", "319|Pasinler", "320|Şenkaya", "321|Tekman", "322|Tortum", "323|Karaçoban", "324|Uzundere", "325|Pazaryolu", "326|Aziziye", "327|Köprüköy", "328|Palandöken", "329|Yakutiye"]; }
            if(city.value === "26"){ optionArray = ["330|Çifteler", "331|Mahmudiye", "332|Mihalıççık", "333|Sarıcakaya", "334|Seyitgazi", "335|Sivrihisar", "336|Alpu", "337|Beylikova", "338|İnönü", "339|Günyüzü", "340|Han", "341|Mihalgazi", "342|Odunpazarı", "343|Tepebaşı"]; }
            if(city.value === "27"){ optionArray = ["344|Araban", "345|İslahiye", "346|Nizip", "347|Oğuzeli", "348|Yavuzeli", "349|Şahinbey", "350|Şehitkamil", "351|Karkamış", "352|Nurdağı"]; }
            if(city.value === "28"){ optionArray = ["353|Alucra", "354|Bulancak", "355|Dereli", "356|Espiye", "357|Eynesil", "358|Giresun Merkez", "359|Görele", "360|Keşap", "361|Şebinkarahisar", "362|Tirebolu", "363|Piraziz", "364|Yağlıdere", "365|Çamoluk", "366|Çanakçı", "367|Doğankent", "368|Güce"]; }
            if(city.value === "29"){ optionArray = ["369|Gümüşhane Merkez", "370|Kelkit", "371|Şiran", "372|Torul", "373|Köse", "374|Kürtün"]; }
            if(city.value === "30"){ optionArray = ["375|Çukurca", "376|Hakkari Merkez", "377|Şemdinli", "378|Yüksekova"]; }
            if(city.value === "31"){ optionArray = ["379|Altınözü", "380|Dörtyol", "381|Hassa", "382|İskenderun", "383|Kırıkhan", "384|Reyhanlı", "385|Samandağ", "386|Yayladağı", "387|Erzin", "388|Belen", "389|Kumlu", "390|Antakya", "391|Arsuz", "392|Defne", "393|Payas"]; }
            if(city.value === "32"){ optionArray = ["394|Atabey", "395|Eğirdir", "396|Gelendost", "397|Isparta Merkez", "398|Keçiborlu", "399|Senirkent", "400|Sütçüler", "401|Şarkikaraağaç", "402|Uluborlu", "403|Yalvaç", "404|Aksu / Isparta", "405|Gönen / Isparta", "406|Yenişarbademli"]; }
            if(city.value === "33"){ optionArray = ["407|Anamur", "408|Erdemli", "409|Gülnar", "410|Mut", "411|Silifke", "412|Tarsus", "413|Aydıncık / Mersin", "414|Bozyazı", "415|Çamlıyayla", "416|Akdeniz", "417|Mezitli", "418|Toroslar", "419|Yenişehir / Mersin"]; }
            if(city.value === "34"){ optionArray = ["420|Adalar", "421|Bakırköy", "422|Beşiktaş", "423|Beykoz", "424|Beyoğlu", "425|Çatalca", "426|Eyüp", "427|Fatih", "428|Gaziosmanpaşa", "429|Kadıköy", "430|Kartal", "431|Sarıyer", "432|Silivri", "433|Şile", "434|Şişli", "435|Üsküdar", "436|Zeytinburnu", "437|Büyükçekmece", "438|Kağıthane", "439|Küçükçekmece", "440|Pendik", "441|Ümraniye", "442|Bayrampaşa", "443|Avcılar", "444|Bağcılar", "445|Bahçelievler", "446|Güngören", "447|Maltepe", "448|Sultanbeyli", "449|Tuzla", "450|Esenler", "451|Arnavutköy", "452|Ataşehir", "453|Başakşehir", "454|Beylikdüzü", "455|Çekmeköy", "456|Esenyurt", "457|Sancaktepe", "458|Sultangazi"]; }
            if(city.value === "35"){ optionArray = ["459|Aliağa", "460|Bayındır", "461|Bergama", "462|Bornova", "463|Çeşme", "464|Dikili", "465|Foça", "466|Karaburun", "467|Karşıyaka", "468|Kemalpaşa / İzmir", "469|Kınık", "470|Kiraz", "471|Menemen", "472|Ödemiş", "473|Seferihisar", "474|Selçuk", "475|Tire", "476|Torbalı", "477|Urla", "478|Beydağ", "479|Buca", "480|Konak", "481|Menderes", "482|Balçova", "483|Çiğli", "484|Gaziemir", "485|Narlıdere", "486|Güzelbahçe", "487|Bayraklı", "488|Karabağlar"]; }
            if(city.value === "36"){ optionArray = ["489|Arpaçay", "490|Digor", "491|Kağızman", "492|Kars Merkez", "493|Sarıkamış", "494|Selim", "495|Susuz", "496|Akyaka"]; }
            if(city.value === "37"){ optionArray = ["497|Abana", "498|Araç", "499|Azdavay", "500|Bozkurt / Kastamonu", "501|Cide", "502|Çatalzeytin", "503|Daday", "504|Devrekani", "505|İnebolu", "506|Kastamonu Merkez", "507|Küre", "508|Taşköprü", "509|Tosya", "510|İhsangazi", "511|Pınarbaşı / Kastamonu", "512|Şenpazar", "513|Ağlı", "514|Doğanyurt", "515|Hanönü", "516|Seydiler"]; }
            if(city.value === "38"){ optionArray = ["517|Bünyan", "518|Develi", "519|Felahiye", "520|İncesu", "521|Pınarbaşı / Kayseri", "522|Sarıoğlan", "523|Sarız", "524|Tomarza", "525|Yahyalı", "526|Yeşilhisar", "527|Akkışla", "528|Talas", "529|Kocasinan", "530|Melikgazi", "531|Hacılar", "532|Özvatan"]; }
            if(city.value === "39"){ optionArray = ["533|Babaeski", "534|Demirköy", "535|Kırklareli Merkez", "536|Kofçaz", "537|Lüleburgaz", "538|Pehlivanköy", "539|Pınarhisar", "540|Vize"]; }
            if(city.value === "40"){ optionArray = ["541|Çiçekdağı", "542|Kaman", "543|Kırşehir Merkez", "544|Mucur", "545|Akpınar", "546|Akçakent", "547|Boztepe"]; }
            if(city.value === "41"){ optionArray = ["548|Gebze", "549|Gölcük", "550|Kandıra", "551|Karamürsel", "552|Körfez", "553|Derince", "554|Başiskele", "555|Çayırova", "556|Darıca", "557|Dilovası", "558|İzmit", "559|Kartepe"]; }
            if(city.value === "42"){ optionArray = ["560|Akşehir", "561|Beyşehir", "562|Bozkır", "563|Cihanbeyli", "564|Çumra", "565|Doğanhisar", "566|Ereğli / Konya", "567|Hadim", "568|Ilgın", "569|Kadınhanı", "570|Karapınar", "571|Kulu", "572|Sarayönü", "573|Seydişehir", "574|Yunak", "575|Akören", "576|Altınekin", "577|Derebucak", "578|Hüyük", "579|Karatay", "580|Meram", "581|Selçuklu", "582|Taşkent", "583|Ahırlı", "584|Çeltik", "585|Derbent", "586|Emirgazi", "587|Güneysınır", "588|Halkapınar", "589|Tuzlukçu", "590|Yalıhüyük"]; }
            if(city.value === "43"){ optionArray = ["591|Altıntaş", "592|Domaniç", "593|Emet", "594|Gediz", "595|Kütahya Merkez", "596|Simav", "597|Tavşanlı", "598|Aslanapa", "599|Dumlupınar", "600|Hisarcık", "601|Şaphane", "602|Çavdarhisar", "603|Pazarlar"]; }
            if(city.value === "44"){ optionArray = ["604|Akçadağ", "605|Arapgir", "606|Arguvan", "607|Darende", "608|Doğanşehir", "609|Hekimhan", "610|Pütürge", "611|Yeşilyurt / Malatya", "612|Battalgazi", "613|Doğanyol", "614|Kale / Malatya", "615|Kuluncak", "616|Yazıhan"]; }
            if(city.value === "45"){ optionArray = ["617|Akhisar", "618|Alaşehir", "619|Demirci", "620|Gördes", "621|Kırkağaç", "622|Kula", "623|Salihli", "624|Sarıgöl", "625|Saruhanlı", "626|Selendi", "627|Soma", "628|Turgutlu", "629|Ahmetli", "630|Gölmarmara", "631|Köprübaşı / Manisa", "632|Şehzadeler", "633|Yunusemre"]; }
            if(city.value === "46"){ optionArray = ["634|Afşin", "635|Andırın", "636|Elbistan", "637|Göksun", "638|Pazarcık", "639|Türkoğlu", "640|Çağlayancerit", "641|Ekinözü", "642|Nurhak", "643|Dulkadiroğlu", "644|Onikişubat"]; }
            if(city.value === "47"){ optionArray = ["645|Derik", "646|Kızıltepe", "647|Mazıdağı", "648|Midyat", "649|Nusaybin", "650|Ömerli", "651|Savur", "652|Dargeçit", "653|Yeşilli", "654|Artuklu"]; }
            if(city.value === "48"){ optionArray = ["655|Bodrum", "656|Datça", "657|Fethiye", "658|Köyceğiz", "659|Marmaris", "660|Milas", "661|Ula", "662|Yatağan", "663|Dalaman", "664|Ortaca", "665|Kavaklıdere", "666|Menteşe", "667|Seydikemer"]; }
            if(city.value === "49"){ optionArray = ["668|Bulanık", "669|Malazgirt", "670|Muş Merkez", "671|Varto", "672|Hasköy", "673|Korkut"]; }
            if(city.value === "50"){ optionArray = ["674|Avanos", "675|Derinkuyu", "676|Gülşehir", "677|Hacıbektaş", "678|Kozaklı", "679|Nevşehir Merkez", "680|Ürgüp", "681|Acıgöl"]; }
            if(city.value === "51"){ optionArray = ["682|Bor", "683|Çamardı", "684|Niğde Merkez", "685|Ulukışla", "686|Altunhisar", "687|Çiftlik"]; }
            if(city.value === "52"){ optionArray = ["688|Akkuş", "689|Aybastı", "690|Fatsa", "691|Gölköy", "692|Korgan", "693|Kumru", "694|Mesudiye", "695|Perşembe", "696|Ulubey / Ordu", "697|Ünye", "698|Gülyalı", "699|Gürgentepe", "700|Çamaş", "701|Çatalpınar", "702|Çaybaşı", "703|İkizce", "704|Kabadüz", "705|Kabataş", "706|Altınordu"]; }
            if(city.value === "53"){ optionArray = ["707|Ardeşen", "708|Çamlıhemşin", "709|Çayeli", "710|Fındıklı", "711|İkizdere", "712|Kalkandere", "713|Pazar / Rize", "714|Rize Merkez", "715|Güneysu", "716|Derepazarı", "717|Hemşin", "718|İyidere"]; }
            if(city.value === "54"){ optionArray = ["719|Akyazı", "720|Geyve", "721|Hendek", "722|Karasu", "723|Kaynarca", "724|Sapanca", "725|Kocaali", "726|Pamukova", "727|Taraklı", "728|Ferizli", "729|Karapürçek", "730|Söğütlü", "731|Adapazarı", "732|Arifiye", "733|Erenler", "734|Serdivan"]; }
            if(city.value === "55"){ optionArray = ["735|Alaçam", "736|Bafra", "737|Çarşamba", "738|Havza", "739|Kavak", "740|Ladik", "741|Terme", "742|Vezirköprü", "743|Asarcık", "744|19 Mayıs", "745|Salıpazarı", "746|Tekkeköy", "747|Ayvacık / Samsun", "748|Yakakent", "749|Atakum", "750|Canik", "751|İlkadım"]; }
            if(city.value === "56"){ optionArray = ["752|Baykan", "753|Eruh", "754|Kurtalan", "755|Pervari", "756|Siirt Merkez", "757|Şirvan", "758|Tillo"]; }
            if(city.value === "57"){ optionArray = ["759|Ayancık", "760|Boyabat", "761|Durağan", "762|Erfelek", "763|Gerze", "764|Sinop Merkez", "765|Türkeli", "766|Dikmen", "767|Saraydüzü"]; }
            if(city.value === "58"){ optionArray = ["768|Divriği", "769|Gemerek", "770|Gürün", "771|Hafik", "772|İmranlı", "773|Kangal", "774|Koyulhisar", "775|Sivas Merkez", "776|Suşehri", "777|Şarkışla", "778|Yıldızeli", "779|Zara", "780|Akıncılar", "781|Altınyayla / Sivas", "782|Doğanşar", "783|Gölova", "784|Ulaş"]; }
            if(city.value === "59"){ optionArray = ["785|Çerkezköy", "786|Çorlu", "787|Hayrabolu", "788|Malkara", "789|Muratlı", "790|Saray / Tekirdağ", "791|Şarköy", "792|Marmaraereğlisi", "793|Ergene", "794|Kapaklı", "795|Süleymanpaşa"]; }
            if(city.value === "60"){ optionArray = ["796|Almus", "797|Artova", "798|Erbaa", "799|Niksar", "800|Reşadiye", "801|Tokat Merkez", "802|Turhal", "803|Zile", "804|Pazar / Tokat", "805|Yeşilyurt / Tokat", "806|Başçiftlik", "807|Sulusaray"]; }
            if(city.value === "61"){ optionArray = ["808|Akçaabat", "809|Araklı", "810|Arsin", "811|Çaykara", "812|Maçka", "813|Of", "814|Sürmene", "815|Tonya", "816|Vakfıkebir", "817|Yomra", "818|Beşikdüzü", "819|Şalpazarı", "820|Çarşıbaşı", "821|Dernekpazarı", "822|Düzköy", "823|Hayrat", "824|Köprübaşı / Trabzon", "825|Ortahisar"]; }
            if(city.value === "62"){ optionArray = ["826|Çemişgezek", "827|Hozat", "828|Mazgirt", "829|Nazımiye", "830|Ovacık / Tunceli", "831|Pertek", "832|Pülümür", "833|Tunceli Merkez"]; }
            if(city.value === "63"){ optionArray = ["834|Akçakale", "835|Birecik", "836|Bozova", "837|Ceylanpınar", "838|Halfeti", "839|Hilvan", "840|Siverek", "841|Suruç", "842|Viranşehir", "843|Harran", "844|Eyyübiye", "845|Haliliye", "846|Karaköprü"]; }
            if(city.value === "64"){ optionArray = ["847|Banaz", "848|Eşme", "849|Karahallı", "850|Sivaslı", "851|Ulubey / Uşak", "852|Uşak Merkez"]; }
            if(city.value === "65"){ optionArray = ["853|Başkale", "854|Çatak", "855|Erciş", "856|Gevaş", "857|Gürpınar", "858|Muradiye", "859|Özalp", "860|Bahçesaray", "861|Çaldıran", "862|Edremit / Van", "863|Saray / Van", "864|İpekyolu", "865|Tuşba"]; }
            if(city.value === "66"){ optionArray = ["866|Akdağmadeni", "867|Boğazlıyan", "868|Çayıralan", "869|Çekerek", "870|Sarıkaya", "871|Sorgun", "872|Şefaatli", "873|Yerköy", "874|Yozgat Merkez", "875|Aydıncık / Yozgat", "876|Çandır", "877|Kadışehri", "878|Saraykent", "879|Yenifakılı"]; }
            if(city.value === "67"){ optionArray = ["880|Çaycuma", "881|Devrek", "882|Ereğli / Zonguldak", "883|Zonguldak Merkez", "884|Alaplı", "885|Gökçebey", "886|Kilimli", "887|Kozlu"]; }
            if(city.value === "68"){ optionArray = ["888|Aksaray Merkez", "889|Ortaköy / Aksaray", "890|Ağaçören", "891|Güzelyurt", "892|Sarıyahşi", "893|Eskil", "894|Gülağaç"]; }
            if(city.value === "69"){ optionArray = ["895|Bayburt Merkez", "896|Aydıntepe", "897|Demirözü"]; }
            if(city.value === "70"){ optionArray = ["898|Ermenek", "899|Karaman Merkez", "900|Ayrancı", "901|Kazımkarabekir", "902|Başyayla", "903|Sarıveliler"]; }
            if(city.value === "71"){ optionArray = ["904|Delice", "905|Keskin", "906|Kırıkkale Merkez", "907|Sulakyurt", "908|Bahşili", "909|Balışeyh", "910|Çelebi", "911|Karakeçili", "912|Yahşihan"]; }
            if(city.value === "72"){ optionArray = ["913|Batman Merkez", "914|Beşiri", "915|Gercüş", "916|Kozluk", "917|Sason", "918|Hasankeyf"]; }
            if(city.value === "73"){ optionArray = ["919|Beytüşşebap", "920|Cizre", "921|İdil", "922|Silopi", "923|Şırnak Merkez", "924|Uludere", "925|Güçlükonak"]; }
            if(city.value === "74"){ optionArray = ["926|Bartın Merkez", "927|Kurucaşile", "928|Ulus", "929|Amasra"]; }
            if(city.value === "75"){ optionArray = ["930|Ardahan Merkez", "931|Çıldır", "932|Göle", "933|Hanak", "934|Posof", "935|Damal"]; }
            if(city.value === "76"){ optionArray = ["936|Aralık", "937|Iğdır Merkez", "938|Tuzluca", "939|Karakoyunlu"]; }
            if(city.value === "77"){ optionArray = ["940|Yalova Merkez", "941|Altınova", "942|Armutlu", "943|Çınarcık", "944|Çiftlikköy", "945|Termal"]; }
            if(city.value === "78"){ optionArray = ["946|Eflani", "947|Eskipazar", "948|Karabük Merkez", "949|Ovacık / Karabük", "950|Safranbolu", "951|Yenice / Karabük"]; }
            if(city.value === "79"){ optionArray = ["952|Kilis Merkez", "953|Elbeyli", "954|Musabeyli", "955|Polateli"]; }
            if(city.value === "80"){ optionArray = ["956|Bahçe", "957|Kadirli", "958|Osmaniye Merkez", "959|Düziçi", "960|Hasanbeyli", "961|Sumbas", "962|Toprakkale"]; }
            if(city.value === "81"){ optionArray = ["963|Akçakoca", "964|Düzce Merkez", "965|Yığılca", "966|Cumayeri", "967|Gölyaka", "968|Çilimli", "969|Gümüşova", "970|Kaynaşlı"]; }

            for(const option in optionArray){
                const pair = optionArray[option].split("|");
                const newOption = document.createElement("option");
                newOption.value = pair[0];
                newOption.innerHTML = pair[1];
                district.options.add(newOption);
            }
        }
    </script>
    <!-- site__body -->
    <div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Ana Sayfa</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.dashboard') }}">Hesabım</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="../images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Adreslerim</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>{{ $title }}</h1>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3 d-flex">
                    <div class="account-nav flex-grow-1">
                        <h4 class="account-nav__title">Kullanıcı İşlemleri</h4>
                        <ul>
                            <li class="account-nav__item">
                                <a href="{{ route('user.dashboard') }}">Genel Bakış</a>
                            </li>
                            <li class="account-nav__item">
                                <a href="{{ route('user.profile') }}">Profilim</a>
                            </li>
                            <li class="account-nav__item">
                                <a href="{{ route('user.orders') }}">Siparişlerim</a>
                            </li>
                            <li class="account-nav__item account-nav__item--active">
                                <a href="{{ route('user.address') }}">Adreslerim</a>
                            </li>
                            <li class="account-nav__item ">
                                <a href="{{ route('user.change_password') }}">Şifre Değiştirme</a>
                            </li>
                            <li class="account-nav__item ">
                                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış</a>
                                <form id="logout-form" action="{{ route('user.logout') }}" method="post" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                    <div class="card">
                        <div class="order-header">
                            <div class="order-header__actions">
                                <a href="{{ route('user.address') }}" class="btn btn-xs btn-secondary">Adreslerime Dön</a>
                            </div>
                            <h5 class="title">{{ $title }}</h5>
                        </div>
                        <div class="card-divider"></div>
                        @if($adres != null)
                        <form action="{{ route('user.edit_address') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="mode" name="mode" value="update">
                            <input type="hidden" id="gidecegiyer" name="gidecegiyer" value="{{ $gidecegiyer }}">
                            <input type="hidden" id="adresid" name="adresid" value="{{ $adres->id }}">
                            <div class="card-body">
                                <div class="row no-gutters">
                                    <div class="col-12 col-lg-10 col-xl-8">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="checkout-first-name">Alıcı Adı</label>
                                                <input type="text" class="form-control" id="checkout-first-name" placeholder="Alıcı Adı" id="receiver_name" name="receiver_name" value="{{ $adres->receiver_name }}" required autofocus>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="checkout-last-name">Alıcı Soyadı</label>
                                                <input type="text" class="form-control" id="checkout-last-name" placeholder="Alıcı Soyadı" id="receiver_surname" name="receiver_surname" value="{{ $adres->receiver_surname }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alıcı Telefon Numarası <span class="text-muted">(10 Haneli olacak şekilde)</span></label>
                                            <input type="text" pattern="^[0-9]+$" class="form-control" id="receiver_phone" name="receiver_phone" placeholder="Alıcının Telefon numarası" value="{{ $adres->receiver_phone }}" maxlength="10" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="block-finder__form-item col-md-6">
                                                <label for="checkout-country">İl</label>
                                                <select name="city_menu" id="city_menu" class="block-finder__select" onchange="populate(this.id, 'district_menu')" required>
                                                    <option value="none">Seçiniz</option>
                                                    @foreach($cities as $city)
                                                        @if($adres->ref_city == $city->cityid)
                                                            <option value="{{ $city->cityid }}" selected>{{ $city->cityname }}</option>
                                                        @else
                                                            <option value="{{ $city->cityid }}">{{ $city->cityname }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="block-finder__form-item col-md-6">
                                                <label for="checkout-country">İlçe</label>
                                                <select name="district_menu" id="district_menu"  class="block-finder__select" required>
                                                    @foreach($districts as $district)
                                                        @if($district->districtid == $adres->ref_district)
                                                        <option value="{{ $district->districtid }}" selected>{{ $district->districtname }}</option>
                                                        @else
                                                            <option value="{{ $district->districtid }}">{{ $district->districtname }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label for="checkout-street-address">Mahalle/Semt</label>
                                            <input type="textarea" class="form-control" id="checkout-quarter" placeholder="Mahalle/Semt"  id="quarter" name="quarter" value="{{ $adres->quarter }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="form-message">Adresiniz</label>
                                            <textarea id="checkout-address" class="form-control" rows="4" placeholder="Adresiniz"  id="address" name="address" required>{{ $adres->address }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                    <span class="form-check-input input-check">
                                                        <span class="input-check__body">
                                                            <input class="input-check__input" type="checkbox" id="varsayilan" name="varsayilan" @if($adres->default == true) checked @endif >
                                                            <span class="input-check__box"></span>
                                                            <svg class="input-check__icon" width="9px" height="7px">
                                                                <use xlink:href="../images/sprite.svg#check-9x7"></use>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                <label class="form-check-label" for="login-remember">Varsayılan adres olarak ayarla</label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3 mb-0">
                                            <button class="btn btn-primary">Kaydet</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                        <form action="{{ route('user.edit_address') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="mode" name="mode" value="record">
                            <input type="hidden" id="gidecegiyer" name="gidecegiyer" value="{{ $gidecegiyer }}">
                            <div class="card-body">
                                <div class="row no-gutters">
                                    <div class="col-12 col-lg-10 col-xl-8">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="checkout-first-name">Alıcı Adı</label>
                                                <input type="text" class="form-control" placeholder="Alıcı Adı" id="receiver_name" name="receiver_name" required autofocus>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="checkout-last-name">Alıcı Soyadı</label>
                                                <input type="text" class="form-control" placeholder="Alıcı Soyadı" id="receiver_surname" name="receiver_surname" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alıcı Telefon Numarası <span class="text-muted">(10 Haneli olacak şekilde)</span></label>
                                            <input type="text" pattern="^[0-9]+$" class="form-control" placeholder="+90 xxx xx xx" id="receiver_phone" name="receiver_phone" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="block-finder__form-item col-md-6">
                                                <label for="checkout-country">İl</label>
                                                <select name="city_menu" id="city_menu" class="block-finder__select" onchange="populate(this.id, 'district_menu')" required>
                                                    <option value="none">Seçiniz</option>
                                                    @foreach($cities as $city)
                                                            <option value="{{ $city->cityid }}">{{ $city->cityname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="block-finder__form-item col-md-6">
                                                <label for="checkout-country">İlçe</label>
                                                <select name="district_menu" id="district_menu"  class="block-finder__select" required>
                                                    <option value="none">Seçiniz</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label for="checkout-street-address">Mahalle/Semt</label>
                                            <input type="textarea" class="form-control" id="checkout-quarter" placeholder="Mahalle/Semt" id="quarter" name="quarter" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="form-message">Adresiniz</label>
                                            <textarea id="checkout-address" class="form-control" rows="4" placeholder="Adresiniz" id="address" name="address" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <span class="form-check-input input-check">
                                                    <span class="input-check__body">
                                                        <input class="input-check__input" type="checkbox" id="varsayilan" name="varsayilan" checked>
                                                        <span class="input-check__box"></span>
                                                        <svg class="input-check__icon" width="9px" height="7px">
                                                            <use xlink:href="../images/sprite.svg#check-9x7"></use>
                                                        </svg>
                                                    </span>
                                                </span>
                                                <label class="form-check-label" for="login-remember">Varsayılan adres olarak ayarla</label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3 mb-0">
                                            <button class="btn btn-primary">Kaydet</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- site__body / end -->
@endsection
