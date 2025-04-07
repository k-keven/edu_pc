/**
 * 图片加载失败处理脚本
 * 当图片加载失败时，替换为占位图标
 */
document.addEventListener('DOMContentLoaded', function() {
    // 处理Logo图片
    const logoImg = document.querySelector('.logo img');
    if (logoImg) {
        logoImg.onerror = function() {
            this.style.display = 'none';
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
            this.parentNode.appendChild(logoDiv);
        };
    }

    // 处理用户头像
    const userImg = document.querySelector('.style_one_headeruser img');
    if (userImg) {
        userImg.onerror = function() {
            this.style.display = 'none';
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
            this.parentNode.appendChild(userDiv);
        };
    }

    // 处理侧边栏图标
    const menuIcons = document.querySelectorAll('.tgg_sider_icon img');
    const menuLabels = ['小', '客', '货', '摩', '三'];
    
    menuIcons.forEach((img, index) => {
        img.onerror = function() {
            this.style.display = 'none';
            const iconDiv = document.createElement('div');
            iconDiv.style.width = '24px';
            iconDiv.style.height = '24px';
            iconDiv.style.background = '#1bb394';
            iconDiv.style.borderRadius = '4px';
            iconDiv.style.display = 'flex';
            iconDiv.style.alignItems = 'center';
            iconDiv.style.justifyContent = 'center';
            iconDiv.style.color = '#fff';
            iconDiv.style.fontWeight = 'bold';
            iconDiv.textContent = index < menuLabels.length ? menuLabels[index] : '图';
            this.parentNode.appendChild(iconDiv);
        };
    });

    // 处理功能区图标
    const functionIcons = document.querySelectorAll('.enter_item_left_img img');
    const functionLabels = ['错', '成', '我', '更'];
    
    functionIcons.forEach((img, index) => {
        img.onerror = function() {
            this.style.display = 'none';
            const iconDiv = document.createElement('div');
            iconDiv.style.width = '32px';
            iconDiv.style.height = '32px';
            iconDiv.style.background = '#1bb394';
            iconDiv.style.borderRadius = '4px';
            iconDiv.style.display = 'flex';
            iconDiv.style.alignItems = 'center';
            iconDiv.style.justifyContent = 'center';
            iconDiv.style.color = '#fff';
            iconDiv.style.fontWeight = 'bold';
            iconDiv.textContent = index < functionLabels.length ? functionLabels[index] : '图';
            this.parentNode.appendChild(iconDiv);
        };
    });

    // 处理所有其他图片
    const allOtherImgs = document.querySelectorAll('img:not(.logo img):not(.style_one_headeruser img):not(.tgg_sider_icon img):not(.enter_item_left_img img)');
    
    allOtherImgs.forEach((img) => {
        img.onerror = function() {
            if (this.width < 20 || this.height < 20) {
                // 对于小图标，例如箭头等
                const arrowDiv = document.createElement('div');
                arrowDiv.style.width = '10px';
                arrowDiv.style.height = '15px';
                arrowDiv.style.borderRight = '2px solid #999';
                arrowDiv.style.borderTop = '2px solid #999';
                arrowDiv.style.transform = 'rotate(45deg)';
                this.parentNode.appendChild(arrowDiv);
            } else {
                // 对于其他一般图片
                const placeholderDiv = document.createElement('div');
                placeholderDiv.style.width = this.width ? this.width + 'px' : '100px';
                placeholderDiv.style.height = this.height ? this.height + 'px' : '100px';
                placeholderDiv.style.background = '#f0f0f0';
                placeholderDiv.style.display = 'flex';
                placeholderDiv.style.alignItems = 'center';
                placeholderDiv.style.justifyContent = 'center';
                placeholderDiv.style.color = '#999';
                placeholderDiv.textContent = '图片';
                this.parentNode.appendChild(placeholderDiv);
            }
            this.style.display = 'none';
        };
    });
}); 