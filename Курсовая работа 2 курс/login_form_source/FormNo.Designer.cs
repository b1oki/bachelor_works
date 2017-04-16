namespace login_form
{
    partial class FormNo
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.labelNo = new System.Windows.Forms.Label();
            this.pictureBoNo = new System.Windows.Forms.PictureBox();
            this.buttonOk = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoNo)).BeginInit();
            this.SuspendLayout();
            // 
            // labelNo
            // 
            this.labelNo.AutoSize = true;
            this.labelNo.Location = new System.Drawing.Point(52, 13);
            this.labelNo.Name = "labelNo";
            this.labelNo.Size = new System.Drawing.Size(140, 13);
            this.labelNo.TabIndex = 1;
            this.labelNo.Text = "Неверное имя или пароль";
            // 
            // pictureBoNo
            // 
            this.pictureBoNo.Image = global::login_form.Properties.Resources._lock;
            this.pictureBoNo.Location = new System.Drawing.Point(13, 13);
            this.pictureBoNo.Name = "pictureBoNo";
            this.pictureBoNo.Size = new System.Drawing.Size(32, 32);
            this.pictureBoNo.TabIndex = 0;
            this.pictureBoNo.TabStop = false;
            // 
            // buttonOk
            // 
            this.buttonOk.Location = new System.Drawing.Point(203, 13);
            this.buttonOk.Name = "buttonOk";
            this.buttonOk.Size = new System.Drawing.Size(75, 23);
            this.buttonOk.TabIndex = 2;
            this.buttonOk.Text = "Ok";
            this.buttonOk.UseVisualStyleBackColor = true;
            this.buttonOk.Click += new System.EventHandler(this.buttonOk_Click);
            // 
            // FormNo
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(290, 57);
            this.Controls.Add(this.buttonOk);
            this.Controls.Add(this.labelNo);
            this.Controls.Add(this.pictureBoNo);
            this.Name = "FormNo";
            this.Text = "Ошибка";
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoNo)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.PictureBox pictureBoNo;
        private System.Windows.Forms.Label labelNo;
        private System.Windows.Forms.Button buttonOk;
    }
}