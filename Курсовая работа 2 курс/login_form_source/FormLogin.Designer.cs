namespace login_form
{
    partial class FormLogin
    {
        /// <summary>
        /// Требуется переменная конструктора.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Освободить все используемые ресурсы.
        /// </summary>
        /// <param name="disposing">истинно, если управляемый ресурс должен быть удален; иначе ложно.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Код, автоматически созданный конструктором форм Windows

        /// <summary>
        /// Обязательный метод для поддержки конструктора - не изменяйте
        /// содержимое данного метода при помощи редактора кода.
        /// </summary>
        private void InitializeComponent()
        {
            this.labelName = new System.Windows.Forms.Label();
            this.labelPass = new System.Windows.Forms.Label();
            this.textBoxName = new System.Windows.Forms.TextBox();
            this.textBoxPass = new System.Windows.Forms.TextBox();
            this.buttonAuth = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // labelName
            // 
            this.labelName.AutoSize = true;
            this.labelName.Location = new System.Drawing.Point(15, 13);
            this.labelName.Name = "labelName";
            this.labelName.Size = new System.Drawing.Size(72, 13);
            this.labelName.TabIndex = 0;
            this.labelName.Text = "Введите имя";
            // 
            // labelPass
            // 
            this.labelPass.AutoSize = true;
            this.labelPass.Location = new System.Drawing.Point(15, 57);
            this.labelPass.Name = "labelPass";
            this.labelPass.Size = new System.Drawing.Size(88, 13);
            this.labelPass.TabIndex = 1;
            this.labelPass.Text = "Введите пароль";
            // 
            // textBoxName
            // 
            this.textBoxName.Location = new System.Drawing.Point(15, 32);
            this.textBoxName.MaxLength = 20;
            this.textBoxName.Name = "textBoxName";
            this.textBoxName.Size = new System.Drawing.Size(141, 20);
            this.textBoxName.TabIndex = 2;
            // 
            // textBoxPass
            // 
            this.textBoxPass.Location = new System.Drawing.Point(15, 76);
            this.textBoxPass.MaxLength = 14;
            this.textBoxPass.Name = "textBoxPass";
            this.textBoxPass.PasswordChar = '*';
            this.textBoxPass.Size = new System.Drawing.Size(141, 20);
            this.textBoxPass.TabIndex = 3;
            // 
            // buttonAuth
            // 
            this.buttonAuth.Location = new System.Drawing.Point(15, 104);
            this.buttonAuth.Name = "buttonAuth";
            this.buttonAuth.Size = new System.Drawing.Size(75, 23);
            this.buttonAuth.TabIndex = 4;
            this.buttonAuth.Text = "Войти";
            this.buttonAuth.UseVisualStyleBackColor = true;
            this.buttonAuth.Click += new System.EventHandler(this.buttonAuth_Click);
            // 
            // FormLogin
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(171, 139);
            this.Controls.Add(this.buttonAuth);
            this.Controls.Add(this.textBoxPass);
            this.Controls.Add(this.textBoxName);
            this.Controls.Add(this.labelPass);
            this.Controls.Add(this.labelName);
            this.Name = "FormLogin";
            this.Text = "Login";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label labelName;
        private System.Windows.Forms.Label labelPass;
        private System.Windows.Forms.TextBox textBoxName;
        private System.Windows.Forms.TextBox textBoxPass;
        private System.Windows.Forms.Button buttonAuth;
    }
}

