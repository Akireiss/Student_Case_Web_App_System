function createCaseElement(caseData) {
    const caseElement = document.createElement('a');
    caseElement.href = '#';
    caseElement.className = 'flex items-start p-1 hover:bg-gray-50 rounded-lg';

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
            dropdownMenu.innerHTML = '';

            const now = new Date();

            // Filter ongoing cases that haven't been updated for the past 3 days
            const filteredOngoingCases = data.ongoingCases.filter((caseData) => {
                const updatedAt = new Date(caseData.updated_at);
                const timeDifference = now - updatedAt;
                const daysDifference = Math.floor(timeDifference / 86400000); // 1 day = 86400000 milliseconds
                return daysDifference >= 3;
            });

            // Filter resolved cases that haven't been updated for the past 3 days
            const filteredResolvedCases = data.resolvedCases.filter((caseData) => {
                const updatedAt = new Date(caseData.updated_at);
                const timeDifference = now - updatedAt;
                const daysDifference = Math.floor(timeDifference / 86400000); // 1 day = 86400000 milliseconds
                return daysDifference >= 3;
            });

            if (filteredOngoingCases.length === 0 && filteredResolvedCases.length === 0) {
                dropdownMenu.innerHTML = '<p>No notifications</p>';
                return;
            }

            filteredOngoingCases.forEach((caseData) => {
                const caseElement = createCaseElement(caseData);
                dropdownMenu.appendChild(caseElement);
            });

            filteredResolvedCases.forEach((caseData) => {
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
