
/*------------------------------------------------------------------Delete for users ------------------------------------------------------*/
let deleteBtns = document.querySelectorAll('.deleteUserBtn');

let confirmDeleteBtn = document.getElementById("confirm-delete");
let formToDelete = document.getElementById("formToDelete");
let urlToConfirmDelete = "";

for (const deleteBtn of deleteBtns) {
    deleteBtn.addEventListener("click", () => {
        document.getElementById('deleteModalLabel').textContent = "Delete sentence";
        document.getElementById('deleteModalBody').textContent = "Are you sure you want to delete this user with email: " + deleteBtn.dataset.email + " and the role: " + deleteBtn.dataset.role;

        confirmDeleteBtn.dataset.id = deleteBtn.dataset.id;

        urlToConfirmDelete = "/" + deleteBtn.dataset.id;
    })
}


confirmDeleteBtn.addEventListener("click", (event)=>{
    formToDelete.action = confirmDeleteBtn.dataset.href + urlToConfirmDelete;
    formToDelete.submit();
});

/*------------------------------------------------------------------Delete for categories--------------------------------------------------*/

let deleteCategoryBtns = document.querySelectorAll('.deleteCategoryBtn');

let confirmCategoryDeleteBtn = document.getElementById("confirm-delete");
let formCategoryToDelete = document.getElementById("formCategoryToDelete");
let urlToConfirmCategoryDelete = "";

for (const deleteCategoryBtn of deleteCategoryBtns) {
    deleteCategoryBtn.addEventListener("click", () => {
        document.getElementById('deleteCategory').textContent = "Delete sentence";
        document.getElementById('deleteCategoryModalBody').textContent = "Are you sure you want to delete this category with name: " + deleteCategoryBtn.dataset.categoryname;


        confirmDeleteBtn.dataset.categoryid = deleteCategoryBtn.dataset.categoryid;

        urlToConfirmCategoryDelete = "/" + deleteCategoryBtn.dataset.categoryid;
    })
}


confirmDeleteBtn.addEventListener("click", (event)=>{
    formCategoryToDelete.action = confirmDeleteBtn.dataset.href + urlToConfirmCategoryDelete;
    formCategoryToDelete.submit();
});
