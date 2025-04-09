 
    function createCustomDialog() {
        // 添加弹出框样式
        var style = `
        <style>
          .custom-dialog-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
            
            /* 加强居中显示 */
            display: flex;
            justify-content: center;
            align-items: center;
          }
          
          .custom-dialog {
            background-color: #fff;
            border-radius: 5px;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            
            /* 确保即使在flex布局下也能正确居中 */
            margin: 0 auto;
            position: relative;
            transform: translateY(0);
            animation: dialogFadeIn 0.3s ease-out;
          }
          
          @keyframes dialogFadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
          }
          
          .custom-dialog-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            position: relative;
          }
          
          .custom-dialog-title {
            color: #f00;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            margin: 0;
          }
          
          .custom-dialog-title:before {
            content: "";
            display: inline-block;
            width: 24px;
            height: 24px;
            background-color: #f93;
            border-radius: 50%;
            margin-right: 10px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'%3E%3Cpath fill='white' d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 15c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm1.5-5h-3v-6h3v6z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 20px;
          }
          
          .custom-dialog-close {
            position: absolute;
            top: 12px;
            right: 15px;
            cursor: pointer;
            color: #999;
            font-size: 24px;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
          }
          
          .custom-dialog-close:hover {
            background-color: #f5f5f5;
            color: #333;
          }
          
          .custom-dialog-body {
            padding: 30px 20px;
            text-align: center;
            font-size: 16px;
            color: #333;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
          }
          
          .custom-dialog-footer {
            padding: 10px 20px 25px;
            text-align: center;
          }
          
          .custom-dialog-btn {
            padding: 8px 30px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 14px;
            margin: 0 10px;
            transition: all 0.3s;
          }
          
          .btn-cancel {
            background-color: #f5f5f5;
            color: #333;
            display: inline-block; /* 允许隐藏 */
          }
          
          .btn-cancel:hover {
            background-color: #e5e5e5;
          }
          
          .btn-confirm {
            background-color: #4dabf7;
            color: white;
          }
          
          .btn-confirm:hover {
            background-color: #3d8bd7;
          }
      
          /* 成功状态 */
          .custom-dialog-title.success {
            color: #2ecc71;
          }
          
          .custom-dialog-title.success:before {
            background-color: #2ecc71;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'%3E%3Cpath fill='white' d='M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z'/%3E%3C/svg%3E");
          }
          
          /* 失败状态 */
          .custom-dialog-title.error {
            color: #e74c3c;
          }
          
          .custom-dialog-title.error:before {
            background-color: #e74c3c;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'%3E%3Cpath fill='white' d='M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z'/%3E%3C/svg%3E");
          }
          
          .btn-confirm.success {
            background-color: #2ecc71;
          }
          
          .btn-confirm.error {
            background-color: #e74c3c;
          }
          
          /* 单按钮模式样式 */
          .single-button .btn-cancel {
            display: none;
          }
          
          .single-button .btn-confirm {
            min-width: 120px;
          }
        </style>`;
        
        // 添加弹出框HTML结构
        var dialogHTML = `
        <div class="custom-dialog-overlay">
          <div class="custom-dialog">
            <div class="custom-dialog-header">
              <h3 class="custom-dialog-title">提示</h3>
              <span class="custom-dialog-close">×</span>
            </div>
            <div class="custom-dialog-body">
              <!-- 动态内容将在这里显示 -->
            </div>
            <div class="custom-dialog-footer">
              <button class="custom-dialog-btn btn-cancel">取消</button>
              <button class="custom-dialog-btn btn-confirm">确定</button>
            </div>
          </div>
        </div>`;
        
        // 将样式和结构添加到页面
        $('head').append(style);
        $('body').append(dialogHTML);
        
        // 定义显示和隐藏函数
        function showDialog() {
          $('.custom-dialog-overlay').css('display', 'flex').hide().fadeIn(300);
        }
        
        function hideDialog() {
          $('.custom-dialog-overlay').fadeOut(300);
        }
        
        // 关闭弹出框的事件处理
        $('.custom-dialog-close, .btn-cancel').on('click', function() {
          hideDialog();
        });
        
        // 挂载弹出框API到jQuery
        $.customDialog = function(options) {
          var settings = $.extend({
            title: '提示',
            content: '',
            cancelText: '取消',
            confirmText: '确定',
            onCancel: function() {},
            onConfirm: function() {},
            type: 'default', // 默认、成功、失败
            singleButton: false // 是否只显示一个按钮
          }, options);
          
          // 恢复默认样式
          $('.custom-dialog-title').removeClass('success error').text(settings.title);
          $('.btn-confirm').removeClass('success error');
          $('.custom-dialog-footer').removeClass('single-button');
          
          // 根据类型设置样式
          if(settings.type === 'success') {
            $('.custom-dialog-title').addClass('success');
            $('.btn-confirm').addClass('success');
          } else if(settings.type === 'error') {
            $('.custom-dialog-title').addClass('error');
            $('.btn-confirm').addClass('error');
          }
          
          // 设置单按钮模式
          if(settings.singleButton) {
            $('.custom-dialog-footer').addClass('single-button');
          }
          
          // 更新弹出框内容
          $('.custom-dialog-body').html(settings.content);
          $('.btn-cancel').text(settings.cancelText);
          $('.btn-confirm').text(settings.confirmText);
          
          // 显示弹出框
          showDialog();
          
          // 绑定按钮事件
          $('.btn-cancel').off('click').on('click', function() {
            settings.onCancel();
            hideDialog();
          });
          
          $('.btn-confirm').off('click').on('click', function() {
            settings.onConfirm();
            hideDialog();
          });
          
          // 点击关闭按钮
          $('.custom-dialog-close').off('click').on('click', function() {
            settings.onCancel();
            hideDialog();
          });
          
          // 点击遮罩层关闭(可选)
          $('.custom-dialog-overlay').off('click').on('click', function(e) {
            if ($(e.target).hasClass('custom-dialog-overlay')) {
              settings.onCancel();
              hideDialog();
            }
          });
        };
        
        // 添加成功状态快捷方法 - 使用单按钮模式
        $.customDialog.success = function(options) {
          if (typeof options === 'string') {
            options = { content: options };
          }
          
          return $.customDialog($.extend({
            title: '成功',
            type: 'success',
            confirmText: '确定',
            singleButton: true
          }, options));
        };
        
        // 添加失败状态快捷方法 - 使用单按钮模式
        $.customDialog.error = function(options) {
          if (typeof options === 'string') {
            options = { content: options };
          }
          
          return $.customDialog($.extend({
            title: '错误',
            type: 'error',
            confirmText: '确定',
            singleButton: true
          }, options));
        };
      }
        