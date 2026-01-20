const wrapper = document.querySelector(".wrapper"),
qrInput = wrapper.querySelector(".form input"),
generateBtn = wrapper.querySelector(".form button"),
qrImg = wrapper.querySelector(".qr-code img");
let preValue;
generateBtn.addEventListener("click", () => {
    let data = [];
    data.push(document.querySelector('input[name=prn]').value);
    data.push(document.querySelector('input[name=name]').value);
    data.push(document.querySelector('input[name=dept]').value);
    data.push(document.querySelector('input[name=division]').value);
    data.push(document.querySelector('input[name=add_yr]').value);
    data.push(document.querySelector('input[name=cyr]').value);
    data.push(document.querySelector('input[name=batch]').value);
    data.push(document.querySelector('input[name=phn]').value);
    data.push(document.querySelector('input[name=address]').value);
    data.push(document.querySelector('input[name=cgpa]').value);

    if(!data || preValue === data) return;
    preValue = data;
    generateBtn.innerText = "Generating QR Code...";
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${JSON.stringify(data)}`;
    qrImg.addEventListener("load", () => {
        wrapper.classList.add("active");
        generateBtn.innerText = "Generate QR Code";
    });
});
qrInput.addEventListener("keyup", () => {
    if(!qrInput.value.trim()) {
        wrapper.classList.remove("active");
        preValue = "";
    }
});

