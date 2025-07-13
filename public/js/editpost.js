//PREVENT FORM SUBMISSION 
document.querySelectorAll(".edit-btn").forEach((e)=>{

    e.addEventListener("click",(event)=>{
          event.preventDefault();
    })
    
});

const post = document.getElementById("post-content");

document.getElementById("bold").addEventListener("click", ()=>{
    let start = post.selectionStart;
    let end = post.selectionEnd;

    const insert = "[B][/B]";
    post.value = `${post.value.substring(0,start)}${insert}${post.value.substring(end,post.value.length)}`;

});
document.getElementById("italic").addEventListener("click", ()=>{
    let start = post.selectionStart;
    let end = post.selectionEnd;

    const insert = "[I][/I]";
    post.value = `${post.value.substring(0,start)}${insert}${post.value.substring(end,post.value.length)}`;

});
document.getElementById("underline").addEventListener("click", ()=>{
    let start = post.selectionStart;
    let end = post.selectionEnd;

    const insert = "[U][/U]";
    post.value = `${post.value.substring(0,start)}${insert}${post.value.substring(end,post.value.length)}`;

});
document.getElementById("center").addEventListener("click", ()=>{
    let start = post.selectionStart;
    let end = post.selectionEnd;

    const insert = "[Center][/Center]";
    post.value = `${post.value.substring(0,start)}${insert}${post.value.substring(end,post.value.length)}`;

});
document.getElementById("quote").addEventListener("click", ()=>{
    let start = post.selectionStart;
    let end = post.selectionEnd;

    const insert = "[Quote][/Quote]";
    post.value = `${post.value.substring(0,start)}${insert}${post.value.substring(end,post.value.length)}`;

});
document.getElementById("image").addEventListener("click", ()=>{
    let start = post.selectionStart;
    let end = post.selectionEnd;

    const insert = "[Img][/Img]";
    post.value = `${post.value.substring(0,start)}${insert}${post.value.substring(end,post.value.length)}`;

});
document.getElementById("link").addEventListener("click", ()=>{
    let start = post.selectionStart;
    let end = post.selectionEnd;

    const insert = "[Url][/Url]";
    post.value = `${post.value.substring(0,start)}${insert}${post.value.substring(end,post.value.length)}`;

});
document.getElementById("spoiler").addEventListener("click", ()=>{
    let start = post.selectionStart;
    let end = post.selectionEnd;

    const insert = "[Spoiler][/Spoiler]";
    post.value = `${post.value.substring(0,start)}${insert}${post.value.substring(end,post.value.length)}`;

});