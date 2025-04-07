// 修复页面布局问题
document.addEventListener('DOMContentLoaded', function() {
  // 移除多余的侧边栏副本
  function removeExtraSidebars() {
    const sidebars = document.querySelectorAll('.sidebar-container');
    if (sidebars.length > 1) {
      for (let i = 1; i < sidebars.length; i++) {
        sidebars[i].remove();
      }
    }
  }
  
  // 修复主内容区容器
  function fixMainContainer() {
    const mainContainers = document.querySelectorAll('.container-main');
    if (mainContainers.length > 1) {
      for (let i = 1; i < mainContainers.length; i++) {
        mainContainers[i].remove();
      }
    }
    
    if (mainContainers.length > 0) {
      const mainContainer = mainContainers[0];
      mainContainer.style.position = 'relative';
      mainContainer.style.zIndex = '5';
      mainContainer.style.margin = '60px 0 0 200px';
      mainContainer.style.padding = '0';
      mainContainer.style.minHeight = 'calc(100vh - 60px)';
      mainContainer.style.width = 'calc(100% - 200px)';
      mainContainer.style.overflow = 'visible';
    }
  }
  
  // 确保科目列表显示正确
  function fixSubjectList() {
    const topWrap = document.querySelector('.styleone_top_wrap');
    if (topWrap) {
      topWrap.style.display = 'block';
      topWrap.style.marginTop = '0';
      topWrap.style.background = '#fff';
      topWrap.style.padding = '20px';
      topWrap.style.boxShadow = '0 1px 3px rgba(0,0,0,0.1)';
    }
    
    const lists = document.querySelectorAll('.styleone_list_item');
    lists.forEach(list => {
      list.style.display = 'flex';
      list.style.flexWrap = 'wrap';
      list.style.gap = '10px';
      list.style.marginBottom = '15px';
    });
    
    const papers = document.querySelectorAll('.styleone_paper');
    papers.forEach(paper => {
      paper.style.display = 'block';
      paper.style.padding = '8px 15px';
      paper.style.cursor = 'pointer';
      paper.style.transition = 'all 0.3s';
      paper.style.backgroundColor = 'rgba(27, 179, 148, 0.05)';
      paper.addEventListener('mouseover', function() {
        this.style.backgroundColor = 'rgba(27, 179, 148, 0.1)';
      });
      paper.addEventListener('mouseout', function() {
        this.style.backgroundColor = 'rgba(27, 179, 148, 0.05)';
      });
    });
  }
  
  // 修复底部功能区
  function fixBottomSection() {
    const bottomWrap = document.querySelector('.styleone_buttom_wrap');
    if (bottomWrap) {
      bottomWrap.style.display = 'grid';
      bottomWrap.style.gridTemplateColumns = 'repeat(auto-fit, minmax(250px, 1fr))';
      bottomWrap.style.gap = '15px';
      bottomWrap.style.padding = '15px';
      bottomWrap.style.marginTop = '20px';
    }
    
    const items = document.querySelectorAll('.style_enter_item');
    items.forEach(item => {
      item.style.background = '#fff';
      item.style.borderRadius = '6px';
      item.style.boxShadow = '0 1px 4px rgba(0, 0, 0, 0.05)';
      item.style.transition = 'all 0.3s';
      item.addEventListener('mouseover', function() {
        this.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.08)';
      });
      item.addEventListener('mouseout', function() {
        this.style.boxShadow = '0 1px 4px rgba(0, 0, 0, 0.05)';
      });
    });
  }
  
  // 确保所有内容可见
  function ensureVisibility() {
    document.querySelectorAll('.el-scrollbar__wrap, .el-scrollbar__view').forEach(el => {
      el.style.background = 'transparent';
      el.style.overflow = 'visible';
    });
    
    document.querySelectorAll('.h100, #app, .bg-gray').forEach(el => {
      el.style.height = '100%';
      el.style.minHeight = '100vh';
    });
  }
  
  // 立即执行所有修复
  setTimeout(function() {
    removeExtraSidebars();
    fixMainContainer();
    fixSubjectList();
    fixBottomSection();
    ensureVisibility();
    
    // 强制刷新布局
    window.dispatchEvent(new Event('resize'));
  }, 100);
}); 