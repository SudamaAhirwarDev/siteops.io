# 🚀 SiteOps — InfinityFree Hosting Complete Guide (स्टेप-बाय-स्टेप गाइड)

यह गाइड आपको **SiteOps** को **InfinityFree (Free Web Hosting)** पर 100% सही तरीके से लाइव करने के सारे स्टेप्स बताती है।

---

## 📋 क्या-क्या चीज़ें तैयार हैं?
हमने आपके लिए पूरी प्रोजेक्ट को InfinityFree के लिए तैयार कर दिया है:
- **`siteops_infinityfree_ready.zip`** — एक सिंगल ZIP फाइल जिसे सीधे InfinityFree के `htdocs` में एक्सट्रैक्ट करना है।
- **`database.sql`** — पूरा डेटाबेस स्कीमा और डिफ़ॉल्ट टेबल्स।
- **Root `.htaccess` & `index.php`** — InfinityFree shared hosting के लिए प्री-कॉन्फिगर किया हुआ।

---

## 🛠️ Step 1: InfinityFree पर Account और Domain बनाएं

1. [https://www.infinityfree.com](https://www.infinityfree.com) पर जाएं और लॉगिन/साइन-अप करें।
2. डैशबोर्ड में **"Create Account"** बटन पर क्लिक करें।
3. **Domain Type:**
   - **Subdomain** चुनें (उदा. `siteops` और एक्सटेंशन `.infinityfreeapp.com` या `.epizy.com`)।
   - (या अगर आपका खुद का कस्टम डोमेन है तो **Custom Domain** चुनें)।
4. **Account Details:** अपना पासवर्ड सेट करें और **Create Account** पर क्लिक करें।
5. आपका अकाउंट 1-2 मिनट में एक्टिव हो जाएगा।

---

## ⚙️ Step 2: PHP Version 8.2 सेट करें (बहुत ज़रूरी!)

CodeIgniter 4 को चलने के लिए **PHP 8.2** की आवश्यकता होती है:
1. InfinityFree के **Control Panel (cPanel / VistaPanel)** में जाएं।
2. **Software** सेक्शन में **"Select PHP Version"** या **"PHP Config"** पर क्लिक करें।
3. अपने डोमेन के सामने ड्रॉपडाउन से **PHP 8.2** चुनें और **Save/Update** करें।

---

## 🗄️ Step 3: MySQL Database बनाएं & `database.sql` Import करें

1. Control Panel में **"MySQL Databases"** पर क्लिक करें।
2. **Create New Database** में नाम डालें (उदा. `siteops`) और **Create Database** पर क्लिक करें।
3. अब स्क्रीन पर आपको ये 4 डीटेल्स मिलेंगी — इन्हें नोट कर लें:
   - **MySQL Hostname:** (उदा. `sql105.infinityfree.com` — *ध्यान दें: `localhost` काम नहीं करेगा!*)
   - **MySQL Database Name:** (उदा. `epiz_12345678_siteops`)
   - **MySQL Username:** (उदा. `epiz_12345678`)
   - **MySQL Password:** (आपके InfinityFree vPanel का पासवर्ड)
4. नीचे उसी पेज पर **"phpMyAdmin"** के लिंक पर क्लिक करें।
5. phpMyAdmin खुलने पर बाएं तरफ अपना डेटाबेस चुनें।
6. ऊपर **"Import"** टैब पर जाएं, **Choose File** में अपनी `database.sql` फाइल चुनें और नीचे **"Go"** या **"Import"** पर क्लिक करें।
   *(सारी 6 टेबल्स सफलतापूर्वक इम्पोर्ट हो जाएंगी).*

---

## 📤 Step 4: Files Upload करें

आप दो तरीकों से फाइलें अपलोड कर सकते हैं:

### तरीका A: Online File Manager से (सबसे आसान)
1. InfinityFree Control Panel में **"Online File Manager"** खोलें।
2. **`htdocs`** फोल्डर के अंदर जाएं।
3. अगर वहां पहले से कोई `index2.html` या डिफ़ॉल्ट फाइल हो, तो उसे डिलीट कर दें।
4. ऊपर **Upload** आइकन पर क्लिक करें और **`siteops_infinityfree_ready.zip`** अपलोड करें।
5. अपलोड होने के बाद ZIP फाइल पर राइट-क्लिक करके **"Extract"** करें।
6. एक्सट्रैक्ट होने के बाद आप ZIP फाइल डिलीट कर सकते हैं।

### तरीका B: FileZilla FTP से
- **FTP Host:** `ftpupload.net`
- **FTP Username:** (आपका cPanel username)
- **FTP Password:** (आपका cPanel password)
- Port: `21`
- कनेक्ट करके सारी फाइल्स सीधे `/htdocs/` के अंदर ड्रैग-एंड-ड्रॉप कर दें।

---

## 🔧 Step 5: `.env` फाइल को अपने डोमेन और डेटाबेस से जोड़ें

File Manager में `htdocs` के अंदर **`.env`** फाइल को खोलें (Edit करें) और ये 5 लाइनें अपडेट करें:

```ini
# 1. Environment
CI_ENVIRONMENT = production

# 2. Base URL (अपने InfinityFree डोमेन का पूरा लिंक डालें, लास्ट में स्लैश / ज़रूर रखें)
app.baseURL = 'http://your-subdomain.infinityfreeapp.com/'

# 3. Database Credentials (जो Step 3 में नोट किए थे)
database.default.hostname = sql105.infinityfree.com
database.default.database = epiz_12345678_siteops
database.default.username = epiz_12345678
database.default.password = your_vpanel_password
database.default.DBDriver = MySQLi
database.default.port = 3306
```
फाइल को **Save** कर दें।

---

## 🎉 Step 6: टेस्ट करें!

अब अपने ब्राउज़र में अपना डोमेन खोलें:
👉 `http://your-subdomain.infinityfreeapp.com/`

आपको लाइव दिखेगा:
- ✅ **New Glowing Shield Logo**
- ✅ **Clean Navbar (Site Health, Features, How It Works, Sign In)**
- ✅ **Instant 4-in-1 Scanner (Cyber Security, TotalVirus, SEO, DOM Bugs)**
- ✅ **WCAG Accessibility Widget & Social Proof Reviews Toast**
- ✅ **Sitemap & AI Directives:**
  - `http://your-subdomain.infinityfreeapp.com/sitemap.xml`
  - `http://your-subdomain.infinityfreeapp.com/robots.txt`
  - `http://your-subdomain.infinityfreeapp.com/llms.txt`

---

## 💡 Troubleshooting Tips (अगर कोई समस्या आए)

1. **"500 Internal Server Error" या ब्लैंक स्क्रीन:**
   - चेक करें कि PHP Version **8.2** सिलेक्ट किया है या नहीं।
   - `.env` में `CI_ENVIRONMENT = development` करके रिफ्रेश करें, एरर साफ़ दिख जाएगा।
2. **Database Connection Error:**
   - सुनिश्चित करें कि hostname में `localhost` नहीं है, बल्कि InfinityFree का `sqlXXX.infinityfree.com` है।
3. **URL Routing / 404 on Subpages:**
   - सुनिश्चित करें कि `.htaccess` फाइल `htdocs/` के रूट में मौजूद है (छुपी फाइल्स देखने के लिए File Manager की सेटिंग्स में "Show Hidden Files" ऑन करें)।
