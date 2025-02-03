/*-------------------------------------------------------------- DELETE THE THUMBNAIL ---------------------------------------------------------------*/
console.log("HOLAAAA");
let deleteBtns = document.querySelectorAll('.delete-image-btn');

let confirmDeleteBtn = document.getElementById("confirm-delete");
let formToDelete = document.getElementById("formToDelete");
let urlToConfirmDelete = "";

for (const deleteBtn of deleteBtns) {
    deleteBtn.addEventListener("click", () => {
        document.getElementById('deleteImageModalLabel').textContent = "Delete sentence";
        document.getElementById('deleteImageModalBody').textContent = "Are you sure you want to delete this image? ";

        confirmDeleteBtn.dataset.id = deleteBtn.dataset.id;

        urlToConfirmDelete = "/" + deleteBtn.dataset.id;
    })
}


confirmDeleteBtn.addEventListener("click", (event)=>{
    formToDelete.action = confirmDeleteBtn.dataset.href + urlToConfirmDelete;
    formToDelete.submit();
});

