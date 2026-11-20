# 🚀 Deploy SiteOps with Git & Free Cloud (Render / Koyeb / Railway)

यह गाइड आपको Git के ज़रिए **SiteOps** को **GitHub + Render.com (100% Free)** पर लाइव करने के 3 आसान स्टेप्स बताती है।

---

## 📌 Step 1: GitHub पर New Repository बनाएं
1. [https://github.com/new](https://github.com/new) पर जाएं (लॉगिन करें)।
2. **Repository name:** `siteops` (या कोई भी नाम) डालें।
3. **Public** या **Private** चुनें।
4. **"Create repository"** पर क्लिक करें।
5. GitHub आपको एक URL देगा, जैसे:
   `https://github.com/YOUR_USERNAME/siteops.git`

---

## 💻 Step 2: Code को GitHub पर Push करें
अपने टर्मिनल / PowerShell में ये 2 कमांड्स रन करें:

```bash
git remote add origin https://github.com/YOUR_USERNAME/siteops.git
git push -u origin main
```
*(GitHub आपका यूजरनेम और पर्सनल एक्सेस टोकन / पासवर्ड पूछेगा, डालते ही पूरा कोड गिटहब पर अपलोड हो जाएगा).*

---

## 🌐 Step 3: Render.com पर 1-Click Live Deploy करें (100% FREE)

1. [https://render.com](https://render.com) पर जाएं और **"Sign in with GitHub"** करें।
2. डैशबोर्ड में ऊपर **"New +"** &rarr; **"Web Service"** पर क्लिक करें।
3. अपनी रिपॉजिटरी **`siteops`** को **Connect** करें।
4. Render अपने-आप हमारी बनाई हुई **`Dockerfile`** डिटेक्ट कर लेगा:
   - **Name:** `siteops`
   - **Instance Type:** `Free`
5. नीचे **"Create Web Service"** पर क्लिक करें!

🎉 **हो गया!** 2-3 मिनट में आपका प्रोजेक्ट एक फ़ास्ट, सिक्योर HTTPS लिंक पर लाइव हो जाएगा:
👉 `https://siteops-xxxx.onrender.com`

---

## 🗄️ Optional: Free Cloud MySQL Database जोड़ना
अगर आप डेटाबेस भी फ्री क्लाउड पर रखना चाहते हैं:
1. [https://tidbcloud.com](https://tidbcloud.com) (Free 25GB Serverless MySQL) या [https://aiven.io](https://aiven.io) पर फ्री डेटाबेस बनाएं।
2. phpMyAdmin / Web console में `database.sql` इंपोर्ट करें।
3. Render के **Environment Variables** में ये 4 वैल्यूज़ जोड़ दें:
   - `database.default.hostname` = (Cloud MySQL Host)
   - `database.default.database` = (Database Name)
   - `database.default.username` = (Username)
   - `database.default.password` = (Password)
