let id=$("input[name*='book_id']");
id.attr("readonly","readonly");

$(".btnedit").click(e =>{
let textValues= displayData(e);

    let id=$("input[name*='book_id']");
    let bookname=$("input[name*='book_name']");
    let bookauthor=$("input[name*='book_author']");
    let publishedyear=$("input[name*='published_year']");
    let bookprice=$("input[name*='book_price']");

    id.val(textValues[0]);
    bookname.val(textValues[1]);
    bookauthor.val(textValues[2]);
    publishedyear.val(textValues[3]);
    bookprice.val(textValues[4].replace(" RS",""));
});

function displayData(e){
    let id=0;
    const td=$("#tbody tr td");
    let textValues=[];


    for(const value of td){
       if(value.dataset.id === e.target.dataset.id){
           textValues[id++]=value.textContent;
       }
    }
    return textValues;
}