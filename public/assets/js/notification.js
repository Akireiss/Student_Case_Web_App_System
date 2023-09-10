function createCaseElement(caseData) {
    const caseElement = document.createElement('a');
    caseElement.href = '#';
    caseElement.className = 'flex items-start p-1 hover:bg-gray-50 rounded-lg';

    // Calculate the time elapsed
    const updatedAt = new Date(caseData.updated_at);
    const now = new Date();
    const timeDifference = now - updatedAt;

    let timeString;

    if (timeDifference < 60000) {
        const seconds = Math.floor(timeDifference / 1000);
        timeString = `${seconds} second${seconds === 1 ? '' : 's'} ago`;
    } else if (timeDifference < 3600000) {
        const minutes = Math.floor(timeDifference / 60000);
        timeString = `${minutes} minute${minutes === 1 ? '' : 's'} ago`;
    } else if (timeDifference < 86400000) {
        const hours = Math.floor(timeDifference / 3600000);
        timeString = `${hours} hour${hours === 1 ? '' : 's'} ago`;
    } else {
        const days = Math.floor(timeDifference / 86400000);
        timeString = `${days} day${days === 1 ? '' : 's'} ago`;
    }

    // Determine the case status and adjust the display accordingly
    const statusText = caseData.case_status === 1 ? 'Ongoing' : 'Resolved';

    caseElement.innerHTML = `
        <div class="ml-1">
            <p class="text-base font-medium text-gray-900">${statusText}</p>
            <p class="mt-1 text-sm text-gray-500">
               <span class="text-red-500">${caseData.first_name} ${caseData.last_name}</span>
               ${statusText === 'Ongoing' ? 'case has not been updated for the past week'
               : 'case was resolved, you can check this student'}
            </p>
            <p class="mt-1 text-sm text-gray-500">${timeString}</p>
        </div>
    `;
    return caseElement;
}

function fetchDataAndPopulateDropdown() {
    $.ajax({
        url: '/get-ongoing-actions',
        type: 'GET',
        success: function (data) {
            const dropdownMenu = document.getElementById('dropdownInformation');

            // Clear any existing content in the dropdown menu
            dropdownMenu.innerHTML = '';

            // Display a message when there are no notifications
            if (data.ongoingCases.length === 0 && data.resolvedCases.length === 0) {
                dropdownMenu.innerHTML = '<p>No notifications</p>';
                return;
            }

            // Loop through the ongoing cases and create HTML elements for each
            data.ongoingCases.forEach((caseData) => {
                const caseElement = createCaseElement(caseData);
                dropdownMenu.appendChild(caseElement);
            });

            // Loop through the resolved cases and create HTML elements for each
            data.resolvedCases.forEach((caseData) => {
                const caseElement = createCaseElement(caseData);
                dropdownMenu.appendChild(caseElement);
            });
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}

fetchDataAndPopulateDropdown();
setInterval(fetchDataAndPopulateDropdown, 10000);
