namespace login_form
{
    partial class FormYes
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
            this.pictureBoxYes = new System.Windows.Forms.PictureBox();
            this.labelYes = new System.Windows.Forms.Label();
            this.buttonOk = new System.Windows.Forms.Button();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxYes)).BeginInit();
            this.SuspendLayout();
            // 
            // pictureBoxYes
            // 
            this.pictureBoxYes.Image = global::login_form.Properties.Resources.unlock;
            this.pictureBoxYes.Location = new System.Drawing.Point(13, 13);
            this.pictureBoxYes.Name = "pictureBoxYes";
            this.pictureBoxYes.Size = new System.Drawing.Size(32, 32);
            this.pictureBoxYes.TabIndex = 0;
            this.pictureBoxYes.TabStop = false;
            // 
            // labelYes
            // 
            this.labelYes.AutoSize = true;
            this.labelYes.Location = new System.Drawing.Point(52, 13);
            this.labelYes.Name = "labelYes";
            this.labelYes.Size = new System.Drawing.Size(127, 13);
            this.labelYes.TabIndex = 1;
            this.labelYes.Text = "Успешная авторизация";
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
            // FormYes
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(290, 57);
            this.Controls.Add(this.buttonOk);
            this.Controls.Add(this.labelYes);
            this.Controls.Add(this.pictureBoxYes);
            this.Name = "FormYes";
            this.Text = "FormYes";
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxYes)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.PictureBox pictureBoxYes;
        private System.Windows.Forms.Label labelYes;
        private System.Windows.Forms.Button buttonOk;
    }
}