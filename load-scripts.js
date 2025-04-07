/**
 * 动态加载脚本
 */
document.addEventListener('DOMContentLoaded', function() {
    // 加载fix.js
    var fixScript = document.createElement('script');
    fixScript.src = './fix.js';
    document.body.appendChild(fixScript);

    // 加载image-fix.js
    var imageFixScript = document.createElement('script');
    imageFixScript.src = './image-fix.js';
    document.body.appendChild(imageFixScript);

    // 图片处理
    function createPlaceholder(type, parent) {
        if (type === 'logo') {
            const logoDiv = document.createElement('div');
            logoDiv.style.width = '120px';
            logoDiv.style.height = '45px';
            logoDiv.style.background = '#fff';
            logoDiv.style.borderRadius = '4px';
            logoDiv.style.display = 'flex';
            logoDiv.style.alignItems = 'center';
            logoDiv.style.justifyContent = 'center';
            logoDiv.style.color = '#1bb394';
            logoDiv.style.fontWeight = 'bold';
            logoDiv.style.fontSize = '18px';
            logoDiv.textContent = '哈喽交规';
            parent.appendChild(logoDiv);
        } else if (type === 'user') {
            const userDiv = document.createElement('div');
            userDiv.style.width = '30px';
            userDiv.style.height = '30px'; 
            userDiv.style.background = '#fff';
            userDiv.style.borderRadius = '50%';
            userDiv.style.display = 'flex';
            userDiv.style.alignItems = 'center';
            userDiv.style.justifyContent = 'center';
            userDiv.style.color = '#1bb394';
            userDiv.style.fontWeight = 'bold';
            userDiv.textContent = '用';
            parent.appendChild(userDiv);
        }
    }

    // 处理logo图片
    const logoImg = document.querySelector('.logo img');
    if (logoImg) {
        logoImg.onerror = function() {
            this.style.display = 'none';
            createPlaceholder('logo', this.parentNode);
        };
        // 强制触发onerror来测试
        if (!logoImg.complete || logoImg.naturalWidth === 0) {
            logoImg.onerror();
        }
    }

    // 处理用户头像
    const userImg = document.querySelector('.style_one_headeruser img');
    if (userImg) {
        userImg.onerror = function() {
            this.style.display = 'none';
            createPlaceholder('user', this.parentNode);
        };
        // 强制触发onerror来测试
        if (!userImg.complete || userImg.naturalWidth === 0) {
            userImg.onerror();
        }
    }
}); 