var add = document.getElementById("increment");
var minus = document.getElementById("decrement");
var pages = document.getElementById("pages");
var count = Number(pages.value);


add.addEventListener("click", function() {
    count += 1;
    pages.value = count;
 
});
minus.addEventListener("click", function(){
    if(count >= 1){
        count-=1;
    }
    pages.value = count;
})
