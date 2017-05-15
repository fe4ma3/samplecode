    // vueで階層のあるリストを回したい時
    var vm = new Vue({
        el:'#mainContent',
        data:{
            lists:[]
        },
        computed:{
            getAllPiyo: function(){
                var piyos = [];
                this.lists.forEach(function(val){
                    val.piyos.forEach(function(val2){
                        piyos.push(val2);
                    });
                });
                return piyos;
            }
        }
    });

    vm.lists =[
        {
            hoge:"hoge1",
            piyos:[
                {name:"name1",value:1},
                {name:"name2",value:2}
            ]
        },
        {
            hoge:"hoge2",
            piyos:[
                {name:"name2",value:3},
                {name:"name2",value:4}
            ]
        },
        {
            hoge:"hoge3",
            piyos:[
                {name:"name3",value:5},
                {name:"name2",value:6}
            ]
        }];
