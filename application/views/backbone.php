<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-3.3.0.min.css">
    </head>
    <body>


        <div class="container">
            <div id="name"></div>
            <div id="status"></div>
            <div id="userData"></div>
            <div id="dataEntryPanel">
                <input type="button" value="change" id="doChange"/>
                <input type="button" value="add" id="doAdd"/>
                <input type="button" value="edit" id="doEdit"/>
                <input type="button" value="delete" id="doDelete"/>
                <input type="button" value="logout" id="logout"/>
            </div>
        </div>
        <?php
        echo $this->session->userdata('isLoggedIn') . '<br/>';
        foreach ($this->session->all_userdata() as $row => $value){
            echo $this->session->userdata($row) . '<br/>';
        }; ?>

        <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/underscore-min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/backbone-min.js"></script>

        <script type="text/javascript">
            let User = Backbone.Model.extend({
                url: '/2017296/codeigniter-restserver-3.0.0/index.php/api/example/users/id/1',
                idAttribute: 'id',
                defaults: {
                    "id": null,
                    "name": "",
                    "email": "",
                    "fact": ""
                }
            })
            let userEntry = new User();
            // userEntry.fetch({async: false});
            // $('#name').html(userEntry.get('name') +' </br>'+ userEntry.get('email'));
            //automating the view
            // let UserEntryView = Backbone.View.extend({
            //     el: '#userData',
            //     initialize: function() {
            //         this.listenTo(this.model, 'sync change', this.render);
            //         this.listenTo(this.model, 'sync change', this.doChange);
            //         this.model.fetch();
            //         // this.render();
            //     },
            //
            //     render: function (){
            //         let html = '<b>Name : </b>' + this.model.get('name');
            //         this.$el.html(html)
            //         return this;
            //     }
            // })
            // let displayUser  = new UserEntryView({model: userEntry});
            //
            // // alert(userEntry.get('name'));
            // // userEntry.set('name', 'Tharusha');
            // // userEntry.set('id', null);
            // // userEntry.save({async: false});
            // // $('#status').html('saved');
            // // $('#status').html(userEntry.get('name') +' </br>'+ userEntry.get('email'));
            // // userEntry.destroy({async: false});
            //
            // function doChange(){
            //     userEntry.set('name', 'Tharusha Wijayabahu');
            // }
            // function doAdd(){
            //     userEntry.set('name', 'Tharusha Wijayabahu');
            //     userEntry.save();
            // }
            // function doEdit(){
            //     // userEntry.set('name', 'Tharusha Wijayabahu');
            //     userEntry.save();
            // }
            // function doDelete(){
            //     userEntry.destroy({async: false});
            // }

            let UsersList = Backbone.Collection.extend({
                url: "<?php echo base_url();?>index.php/api/example/users",
                // '/2017296/codeigniter-restserver-3.0.0/index.php/api/example/users/',
                model: User
            });

            let userList = new UsersList();
            // userList.fetch({async: false});

            let DataEntryView = Backbone.View.extend({
                el: '#dataEntryPanel',
                initialize: function () {
                    this.listenTo(this.model, 'sync', this.render);
                    this.model.fetch();
                },
                render: function () {
                    let stuff = 'Hi';
                    this.model.each(function (item) {
                        stuff += '<br/>Name: ' + item.get('name');
                    });
                    $('#userData').html(stuff);
                },
                events: {
                    'click #doChange': 'doChange',
                    'click #doAdd': 'doAdd',
                },
                doChange: function () {
                    alert('Do Change');
                },
                doAdd: function () {
                    alert('Do Add');
                },
            });
            let dataEntryView = new DataEntryView({model: userList});
        </script>

    </body>
</html>