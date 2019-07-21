using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace login_form
{
    public partial class FormLogin : Form
    {
        public FormLogin()
        {
            InitializeComponent();
        }

        private void buttonAuth_Click(object sender, EventArgs e)
        {
            string[] lines;
            bool isUser = false;
            try
            {
                lines = File.ReadAllLines("users.txt", Encoding.UTF8);
            }
            catch (IOException)
            {
                lines = new string[1];
                lines[0] = "Error";
            }
            foreach (string line in lines)
            {
                if (textBoxName.Text != "" && textBoxPass.Text != "" && line == textBoxName.Text + ":" + textBoxPass.Text)
                {
                    isUser = true;
                    break;
                }
            }
            if (isUser)
            {
                FormYes formYes = new FormYes();
                formYes.ShowInTaskbar = false;
                formYes.StartPosition = FormStartPosition.CenterParent;
                formYes.ShowDialog(this);
            }
            else
            {
                FormNo formNo = new FormNo();
                formNo.ShowInTaskbar = false;
                formNo.StartPosition = FormStartPosition.CenterParent;
                formNo.ShowDialog(this);
            }
        }
    }
}