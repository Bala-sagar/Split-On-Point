$("#amount, #mem").keyup(function(){
    var amount = $("#amount").val();
    var count = $("#mem").val().trim().split(" ").length + 1;
    var value = (Math.round(amount / count * 100) / 100).toFixed(2);
    $("#perPerson").val(value);
    $("#amountText").text("₹ " + value + " / person");
});

$(".expense").click(function(){
    if($(this).hasClass("active")){
        $(this).removeClass("active");
    } else {
        $(this).addClass("active");
    }
});

var selected = [];

function handleSelect(id){
    if(selected.includes(id)){
        selected = selected.filter(function(item){
            return item != id;
        });
    } else {
        selected.push(id);
    }
    $("#actid").val(selected.join(" "));
};