// const wrapper = document.querySelector(".wrapper"),
// form = document.querySelector("form"),
// fileInp = form.querySelector("input"),
// infoText = form.querySelector("p"),
// closeBtn = document.querySelector(".close"),
// copyBtn = document.querySelector(".copy");

// function fetchRequest(file, formData) {
//     infoText.innerText = "Scanning QR Code...";
//     fetch("http://api.qrserver.com/v1/read-qr-code/", {
//         method: 'POST', body: formData
//     }).then(res => res.json()).then(result => {
//         result = result[0].symbol[0].data;
//         infoText.innerText = result ? "Upload QR Code to Scan" : "Couldn't scan QR Code";
//         if(!result) return;
//         document.querySelector("textarea").innerText = result;
//         form.querySelector("img").src = URL.createObjectURL(file);
//         wrapper.classList.add("active");
//     }).catch(() => {
//         infoText.innerText = "Couldn't scan QR Code";
//     });
// }

// fileInp.addEventListener("change", async e => {
//     let file = e.target.files[0];
//     if(!file) return;
//     let formData = new FormData();
//     formData.append('file', file);
//     fetchRequest(file, formData);
// });

// copyBtn.addEventListener("click", () => {
//     let text = document.querySelector("textarea").textContent;
//     navigator.clipboard.writeText(text);
// });

// form.addEventListener("click", () => fileInp.click());

// const wrapper = document.querySelector(".wrapper"),
//     form = document.querySelector("form"),
//     fileInp = form.querySelector("input"),
//     infoText = form.querySelector("p"),
//     closeBtn = document.querySelector(".close"),
//     copyBtn = document.querySelector(".copy");

// function fetchRequest(file, formData) {
//     infoText.innerText = "Scanning QR Code...";
//     fetch("http://api.qrserver.com/v1/read-qr-code/", {
//         method: 'POST', body: formData
//     }).then(res => res.json()).then(result => {
//         result = result[0].symbol[0].data;
//         infoText.innerText = result ? "Upload QR Code to Scan" : "Couldn't scan QR Code";
//         if (!result) return;

//         try {
//             const studentData = JSON.parse(result);
//             displayStudentData(studentData); // Call the function to display data in a table
//         } catch (e) {
//             infoText.innerText = "Invalid QR Code Data";
//             console.error("Error parsing JSON:", e);
//         }

//         form.querySelector("img").src = URL.createObjectURL(file);
//         wrapper.classList.add("active");
//     }).catch(() => {
//         infoText.innerText = "Couldn't scan QR Code";
//     });
// }

// function displayStudentData(data) {
//     const detailsDiv = document.querySelector(".details");
//     detailsDiv.innerHTML = ""; // Clear existing content

//     const table = document.createElement("table");
//     table.style.width = "100%";
//     table.style.borderCollapse = "collapse";
//     table.style.border = "1px solid black";

//     const headers = ["PRN", "Name", "Department", "Division", "Admission Year", "Current Year", "Batch", "Phone", "Address", "CGPA"];

//     // Create table header
//     let headerRow = table.insertRow();
//     headers.forEach(headerText => {
//         let header = document.createElement("th");
//         header.textContent = headerText;
//         header.style.border = "1px solid black";
//         headerRow.appendChild(header);
//     });

//     // Create table data row
//     let dataRow = table.insertRow();
//     data.forEach(value => {
//         let cell = document.createElement("td");
//         cell.textContent = value;
//         cell.style.border = "1px solid black";
//         dataRow.appendChild(cell);
//     });

//     detailsDiv.appendChild(table);
//     // Remove textarea and copy button
//     const copyBtn = document.querySelector('.copy');
//     const textArea = document.querySelector('textarea');
//     if(copyBtn) copyBtn.remove();
//     if(textArea) textArea.remove();
// }

// fileInp.addEventListener("change", async e => {
//     let file = e.target.files[0];
//     if (!file) return;
//     let formData = new FormData();
//     formData.append('file', file);
//     fetchRequest(file, formData);
// });

// form.addEventListener("click", () => fileInp.click());

// const wrapper = document.querySelector(".wrapper"),
//     form = document.querySelector("form"),
//     fileInp = form.querySelector("input"),
//     infoText = form.querySelector("p"),
//     closeBtn = document.querySelector(".close"),
//     copyBtn = document.querySelector(".copy");

// function fetchRequest(file, formData) {
//     infoText.innerText = "Scanning QR Code...";
//     fetch("http://api.qrserver.com/v1/read-qr-code/", {
//         method: 'POST', body: formData
//     }).then(res => res.json()).then(result => {
//         result = result[0].symbol[0].data;
//         infoText.innerText = result ? "Upload QR Code to Scan" : "Couldn't scan QR Code";
//         if (!result) return;

//         try {
//             const studentData = JSON.parse(result);
//             displayStudentData(studentData);
//         } catch (e) {
//             infoText.innerText = "Invalid QR Code Data";
//             console.error("Error parsing JSON:", e);
//         }

//         form.querySelector("img").src = URL.createObjectURL(file);
//         wrapper.classList.add("active");
//     }).catch(() => {
//         infoText.innerText = "Couldn't scan QR Code";
//     });
// }

// function displayStudentData(data) {
//     const detailsDiv = document.querySelector(".details");
//     detailsDiv.innerHTML = "";

//     const table = document.createElement("table");
//     table.style.width = "100%";
//     table.style.borderCollapse = "collapse";
//     table.style.border = "1px solid black";

//     const headers = ["PRN", "Name", "Department", "Division", "Admission Year", "Current Year", "Batch", "Phone", "Address", "CGPA"];

//     // Create table rows for each field and value
//     headers.forEach((headerText, index) => {
//         let row = table.insertRow();

//         let fieldCell = row.insertCell(0);
//         fieldCell.textContent = headerText + ":"; // Add colon for clarity
//         fieldCell.style.border = "1px solid black";
//         fieldCell.style.fontWeight = "bold"; // Make field labels bold

//         let valueCell = row.insertCell(1);
//         valueCell.textContent = data[index];
//         valueCell.style.border = "1px solid black";
//     });

//     detailsDiv.appendChild(table);

//     const copyBtn = document.querySelector('.copy');
//     const textArea = document.querySelector('textarea');
//     if(copyBtn) copyBtn.remove();
//     if(textArea) textArea.remove();
// }

// fileInp.addEventListener("change", async e => {
//     let file = e.target.files[0];
//     if (!file) return;
//     let formData = new FormData();
//     formData.append('file', file);
//     fetchRequest(file, formData);
// });

// form.addEventListener("click", () => fileInp.click());

const wrapper = document.querySelector(".wrapper"),
    form = document.querySelector("form"),
    fileInp = form.querySelector("input"),
    infoText = form.querySelector("p"),
    modal = document.getElementById("studentModal"),
    modalDetails = document.getElementById("modal-details"),
    closeModal = document.querySelector(".close-modal");

function fetchRequest(file, formData) {
    infoText.innerText = "Scanning QR Code...";
    fetch("http://api.qrserver.com/v1/read-qr-code/", {
        method: 'POST', body: formData
    }).then(res => res.json()).then(result => {
        result = result[0].symbol[0].data;
        infoText.innerText = result ? "Upload QR Code to Scan" : "Couldn't scan QR Code";
        if (!result) return;

        try {
            const studentData = JSON.parse(result);
            displayStudentData(studentData);
            modal.style.display = "block"; // Show the modal
        } catch (e) {
            infoText.innerText = "Invalid QR Code Data";
            console.error("Error parsing JSON:", e);
        }

        form.querySelector("img").src = URL.createObjectURL(file);
        wrapper.classList.add("active");
    }).catch(() => {
        infoText.innerText = "Couldn't scan QR Code";
    });
}

function displayStudentData(data) {
    modalDetails.innerHTML = ""; // Clear existing content

    const table = document.createElement("table");
    table.style.width = "100%";
    table.style.borderCollapse = "collapse";
    table.style.border = "1px solid black";

    const headers = ["PRN", "Name", "Department", "Division", "Admission Year", "Current Year", "Batch", "Phone", "Address", "CGPA"];

    headers.forEach((headerText, index) => {
        let row = table.insertRow();

        let fieldCell = row.insertCell(0);
        fieldCell.textContent = headerText + ":";
        fieldCell.style.border = "1px solid black";
        fieldCell.style.fontWeight = "bold";

        let valueCell = row.insertCell(1);
        valueCell.textContent = data[index];
        valueCell.style.border = "1px solid black";
    });

    modalDetails.appendChild(table);
}

fileInp.addEventListener("change", async e => {
    let file = e.target.files[0];
    if (!file) return;
    let formData = new FormData();
    formData.append('file', file);
    fetchRequest(file, formData);
});

form.addEventListener("click", () => fileInp.click());

// Close the modal when the close button is clicked
closeModal.addEventListener("click", () => {
    modal.style.display = "none";
});

// Close the modal when the user clicks outside of it
window.addEventListener("click", (event) => {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});