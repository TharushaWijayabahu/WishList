document.getElementById("addListBtn").onclick = function fun() {
    let list = new WishList();
    let name = $("#addListModal").find('input[name="name"]').val();
    let occasion = $("#addListModal").find('input[name="occasion"]').val();
    let description = $('textarea#description').val();
    let img_url = $("#addListModal").find('input[name="list_img_url"]').val();
    if (isEmpty(name) && isEmpty(occasion) && isEmpty(description)) {
        list.set({
            "name": name,
            "occasion": occasion,
            "description": description,
            "img_url": img_url,
        });
        list.save({}, {
            async: false,
            success: function (data, statusText) {
                wishList.set({
                    "id": statusText.id,
                    "u_id": statusText.u_id,
                    "name": statusText.name,
                    "occasion": statusText.occasion,
                    "description": statusText.description,
                    "img_url": statusText.img_url,
                    "created_at": statusText.created_at,
                    "updated_at": statusText.updated_at
                });
                $('#addListModal').on('hidden.bs.modal', function (e) {
                    $("#addListModal").find('input[name="name"]').val('');
                    $("#addListModal").find('input[name="occasion"]').val('');
                    $("#addListModal").find('input[name="list_img_url"]').val('');
                    $('textarea#description').val('');
                });
                $('#addListModal').modal('hide');
            },
            error: function (data, statusText) {
                alert(statusText.responseJSON.message);
            }
        });
    } else {
        alert("You must fill out all fields.");
    }
}

function updateList(id) {
    let modelToEdit = wishList;
    $('#editListModal').find('input[name="edit_name"]').val(modelToEdit.get('name'));
    $('#editListModal').find('input[name="edit_occasion"]').val(modelToEdit.get('occasion'));
    $('textarea#edit_description').val(modelToEdit.get('description'));

    document.getElementById("updateListBtn").onclick = function fun() {
        let name = $("#editListModal").find('input[name="edit_name"]').val();
        let occasion = $("#editListModal").find('input[name="edit_occasion"]').val();
        let description = $('textarea#edit_description').val();
        let img_url = $("#editListModal").find('input[name="edit_list_img_url"]').val();

        if (isEmpty(name) && isEmpty(occasion) && isEmpty(description)) {
            modelToEdit.set({
                "id": id,
                "name": name,
                "occasion": occasion,
                "description": description,
                "img_url": img_url,
            });
            modelToEdit.save(null, {
                async: false,
                success: function (data, statusText) {
                    wishList.set({
                        "id": statusText.id,
                        "u_id": statusText.u_id,
                        "name": statusText.name,
                        "occasion": statusText.occasion,
                        "description": statusText.description,
                        "img_url": statusText.img_url,
                        "created_at": statusText.created_at,
                        "updated_at": statusText.updated_at
                    });
                    $('#editItemModal').on('hidden.bs.modal', function (e) {
                        $('#editListModal').find('input[name="edit_name"]').val(modelToEdit.get('name'));
                        $('#editListModal').find('input[name="edit_occasion"]').val(modelToEdit.get('occasion'));
                        $('#editListModal').find('input[name="edit_list_img_url"]').val(modelToEdit.get('img_url'));
                        $('textarea#edit_description').val(modelToEdit.get('description'));
                    });
                    $('#editListModal').modal('hide');
                },
                error: function (data, statusText) {
                    alert(statusText.responseJSON.message);
                }
            });
        } else {
            alert("You must fill out all fields.");
        }
    }
}

function deleteList(id) {
    let modelToDelete = wishList;
    document.getElementById("confirmDeleteListBtn").onclick = function fun() {
        modelToDelete.destroy({
            async: false,
            url: url + 'index.php/api/wishList/wishlist/id/' + id,
            success: function (data, statusText) {
                $('#confirm-modal-delete-list').modal('hide');
                wishList.clear(modelToDelete);
            },
            error: function (data, statusText) {
                alert(statusText.responseJSON.message);
            }
        });
    }
}

document.getElementById("addItemBtn").onclick = function fun() {
    let item = new Item();
    let title = $("#myModal").find('input[name="title"]').val();
    let price = $("#myModal").find('input[name="price"]').val();
    let quantity = $("#myModal").find('input[name="quantity"]').val();
    let url = $("#myModal").find('input[name="url"]').val();
    let img_url = $("#myModal").find('input[name="img_url"]').val();
    let pr_name = $("#priorities option:selected").data('name');
    let pr_level = $("#priorities option:selected").data('pr_level');
    let pr_id = $("#priorities option:selected").val();
    if (isEmpty(title) && isEmpty(price) && isEmpty(quantity) && isEmpty(url)) {
        item.set({
            "pr_id": pr_id,
            "pr_name": pr_name,
            "pr_level": pr_level,
            "title": title,
            "price": price,
            "qty": quantity,
            "url": url,
            "img_url": img_url,
        })
        item.save({}, {
            async: false,
            success: function (data, statusText) {
                wishListItems.add(item);
                wishListItems.sort();
                $('#myModal').on('hidden.bs.modal', function (e) {
                    $("#myModal").find('input[name="title"]').val('');
                    $("#myModal").find('input[name="price"]').val('');
                    $("#myModal").find('input[name="quantity"]').val('');
                    $("#myModal").find('input[name="url"]').val('');
                    $("#myModal").find('input[name="img_url"]').val('');
                });
                $('#myModal').modal('hide');
            },
            error: function (data, statusText) {
                alert(statusText.responseJSON.message);
            }
        });
    } else {
        alert("You must fill out all fields.");
    }
}

document.getElementById("shareLinkAccess").onchange = function fun() {
    let value = $('#shareLinkAccess').val();
    shareLink.set({
        'is_shared': value
    });
    shareLink.save({}, {
        async: false,
        success: function (data, statusText) {
            shareLink.set({
                "id": statusText.id,
                "u_id": statusText.u_id,
                "w_id": statusText.w_id,
                "url": statusText.url,
                "is_shared": statusText.is_shared,
                "created_at": statusText.created_at,
                "updated_at": statusText.updated_at,
            })
        }, error: function (data, statusText) {
            alert(statusText.responseJSON.message);
        }
    });
}

function copyToClipboard() {
    /* Get the text field */
    let copyText = document.getElementById("shareLinkUrl");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");
    $(".message").text("link copied");
}

function updateItem(id) {
    let modelToEdit = new Item();
    modelToEdit = wishListItems.get(id);
    $('#editItemModal').find('input[name="editTitle"]').val(modelToEdit.get('title'));
    $('#editItemModal').find('input[name="editPrice"]').val(modelToEdit.get('price'));
    $('#editItemModal').find('input[name="editQuantity"]').val(modelToEdit.get('qty'));
    $('#editItemModal').find('input[name="editUrl"]').val(modelToEdit.get('url'));
    $('#editItemModal').find('input[name="editImg_url"]').val(modelToEdit.get('img_url'));

    document.getElementById("updateItemBtn").onclick = function fun() {
        let title = $("#editItemModal").find('input[name="editTitle"]').val();
        let price = $("#editItemModal").find('input[name="editPrice"]').val();
        let quantity = $("#editItemModal").find('input[name="editQuantity"]').val();
        let url = $("#editItemModal").find('input[name="editUrl"]').val();
        let img_url = $("#editItemModal").find('input[name="editImg_url"]').val();
        let pr_id = $("#editPriorities option:selected").val();
        let pr_name = $("#editPriorities option:selected").data('name');
        let pr_level = $("#editPriorities option:selected").data('pr_level');

        if (isEmpty(title) && isEmpty(price) && isEmpty(quantity) && isEmpty(url) && isEmpty(img_url)) {
            modelToEdit.set({
                "id": id,
                "pr_id": pr_id,
                "pr_name": pr_name,
                "pr_level": pr_level,
                "title": title,
                "price": price,
                "qty": quantity,
                "url": url,
                "img_url": img_url,
            });
            modelToEdit.save(null, {
                async: false,
                success: function (data, statusText) {
                    wishListItems.add(modelToEdit);
                    wishListItems.sort();
                    $('#editItemModal').on('hidden.bs.modal', function (e) {
                        $('#editItemModal').find('input[name="editTitle"]').val('');
                        $('#editItemModal').find('input[name="editPrice"]').val('');
                        $('#editItemModal').find('input[name="editQuantity"]').val('');
                        $('#editItemModal').find('input[name="editUrl"]').val('');
                        $('#editItemModal').find('input[name="editImg_url"]').val('');
                    });
                    $('#editItemModal').modal('hide');
                },
                error: function (data, statusText) {
                    alert(statusText.responseJSON.message);
                }
            });
        } else {
            alert("You must fill out all fields.");
        }
    }
}

function deleteItem(id) {
    let modelToDelete = wishListItems.get(id);
    $('#confirmMessage').text('Are you sure to delete this item?');
    document.getElementById("confirmDeleteBtn").onclick = function fun() {
        modelToDelete.destroy({
            async: false,
            url: url + 'index.php/api/wishItem/item/id/' + id,
            success: function (data, statusText) {
                $('#confirm-modal').modal('hide');
                wishListItems.remove(modelToDelete);

            },
            error: function (data, statusText) {
                alert(statusText.responseJSON.message);
            }
        });
    }
}

function signOut() {
    let signOut = new SignOut();
    signOut.save({}, {
        async: false,
        success: function (data, statusText) {
            window.location = url + 'index.php/Login'
        },
        error: function (data, statusText) {
            alert(statusText.responseJSON.message);
        }
    });
}

function isEmpty(value) {
    return !(value == null || value === '');
}