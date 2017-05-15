<html>
<head>
    <script src="https://unpkg.com/vue"></script>
    <style type="text/css">
    <!--
    table {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
}
table th {
    width: 150px;
    padding: 10px;
    font-weight: bold;
    vertical-align: top;
    border: 1px solid #ccc;
}
table td {
    width: 350px;
    padding: 10px;
    vertical-align: top;
    border: 1px solid #ccc;
}

    -->
    </style>
</head>
<body>
    <div id="mainContent" v-cloak>
        <table style="">
            <thead>
            <th>hoge</th>
            <th v-for="piyo in getAllPiyo" :id="piyo.name">{{piyo.value}}</th>
            </thead>
        </table>
    </div>
    <script src="./js/customComponent.js"></script>
</body>
</html>
