// 增强菜单交互效果
document.addEventListener('DOMContentLoaded', function() {
    // 为所有菜单项添加点击效果
    const menuItems = document.querySelectorAll('.el-menu-item');
    
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            // 移除所有菜单项的激活状态
            menuItems.forEach(el => {
                el.classList.remove('is-active');
                const textEl = el.querySelector('.tgg_sider_text');
                if (textEl) textEl.classList.remove('style_title_active');
            });
            
            // 添加激活状态到当前点击的项目
            this.classList.add('is-active');
            const activeText = this.querySelector('.tgg_sider_text');
            if (activeText) activeText.classList.add('style_title_active');
            
            // 添加过渡效果到主内容区
            const mainContent = document.querySelector('.container-main');
            if (mainContent) {
                mainContent.style.opacity = '0.7';
                mainContent.style.transition = 'opacity 0.3s';
                setTimeout(() => {
                    mainContent.style.opacity = '1';
                }, 100);
            }
        });
    });
    
    // 为试题列表添加点击效果
    const paperItems = document.querySelectorAll('.styleone_paper');
    
    paperItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            this.style.borderColor = '#409EFF';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
            this.style.borderColor = '';
        });
    });
    
    // 为功能按钮添加悬停效果
    const functionItems = document.querySelectorAll('.style_enter_item');
    
    functionItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });
    
    // 切换考前冲刺按钮效果
    const chongciBtn = document.querySelector('.chongci');
    if (chongciBtn) {
        chongciBtn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 4px 12px rgba(64, 158, 255, 0.4)';
        });
        
        chongciBtn.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    }
}); 