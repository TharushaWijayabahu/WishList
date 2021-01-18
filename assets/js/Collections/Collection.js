
let WishItemCollection = Backbone.Collection.extend({
    url: url + 'index.php/api/wishItem/item',
    idAttribute: 'id',
    model: Item,
    comparator: function (item) {
        return item.get("pr_level");
    }
});

let Priorities = Backbone.Collection.extend({
    url: url + 'index.php/api/wishItem/priority',
    idAttribute: 'id',
    model: Priority,
});