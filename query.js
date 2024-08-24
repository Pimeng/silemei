document.addEventListener("DOMContentLoaded", () => {
    fetch('api.php?status=&key=&goc=get&name=pimeng')// 若要自定义名字请修改这里的"pimeng"
        .then(response => response.text())
        .then(data => {
            const statusElement = document.getElementById('status');
            const additionalInfoElement = document.getElementById('additional-info');
            statusElement.classList.remove('sleeping', 'awake', 'error','unknow'); // 移除所有状态类
            if (data.trim() === '0') {
                statusElement.textContent = '睡似了';
                statusElement.classList.add('sleeping');
                additionalInfoElement.textContent = '如果情况紧急，请直接以电话等方式和皮梦取得联系。';
            } else if (data.trim() === '1') {
                statusElement.textContent = '醒着';
                statusElement.classList.add('awake');
                additionalInfoElement.textContent = '这意味着你可以直接通过任何方式和皮梦取得联系。';
            } else if (data.trim() === '2') {
                statusElement.textContent = '未知';
                statusElement.classList.add('unknow');
                additionalInfoElement.textContent = '这种情况下咱也不知道哦~';
            } else {
                statusElement.textContent = '<!>后端响应出错<!>';
                statusElement.classList.add('error');
                additionalInfoElement.textContent = '错误会很快恢复。如果情况紧急，请直接以电话等方式和皮梦取得联系。';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const statusElement = document.getElementById('status');
            const additionalInfoElement = document.getElementById('additional-info');
            statusElement.textContent = '<!>请求失败<!>';
            statusElement.classList.add('error');
            additionalInfoElement.textContent = '错误会很快恢复。如果情况紧急，请直接以电话等方式和皮梦取得联系。';
        });
});

