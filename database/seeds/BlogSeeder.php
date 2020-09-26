<?php

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blog1 = [
                'language' => 'EN',
                'title' => 'Questions about Fish Consumption',
                'slug' => $this->getSlug('Questions about Fish Consumption'),
                'author_id' => 1,
                'content' => '
                    <h4>Why should we eat fish?</h4>
                    <p>Fish is a highly nutritious food that contains protein, iodine, several important vitamins and minerals. Along with that, it is easy to digest compared with other types of meat. Its nutritional value makes it a unique gift of nature.</p>
                    
                    <h4>Why is it important to include fish in our diet?</h4>
                    <p>The nutritional value of fish makes it an ideal staple food. Regular consumption of fish has been linked with numerous health benefits including:</p>
                    <ul>
                        <li>Enhancement in mental and physical strength.</li>
                        <li>Relief in stress.</li>
                        <li>Excellent source of Vitamin-D.</li>
                        <li>Limits the chances of Diabetes.</li>
                        <li>Helps children fighting against Asthma.</li>
                        <li>Reduces aging and protects eye vision.</li>
                        <li>Improves sleeping pattern.</li>
                    </ul>
                    <p>Apart from the above, a group of fish known as ‘Fatty Fish’ contains Omega-3 in abundance which helps in reducing the cardiac diseases if consumed regularly.</p>
                    
                    <h4>From nutritional point of view, how much and how often a healthy man should consume fish? Also, what is the ideal time/season for consuming fish?</h4>
                    <p>Consumption of fish throughout the year is beneficial. Fish is an excellent remedy for fatigue and helps heal bodily wounds. ‘Sole fish’ has an abundance of ‘albumin protein’. Consumption of sole fish is highly beneficial for women who underwent C-section surgery during childbearing process.</p>
                    <p>According to Food and Agriculture Organization (FAO), a healthy person should consume:</p>
                    <ul>
                        <li>At least 20 Kg of fish meat every year.</li>
                        <li>1/4 Kg (250 Grams) of fish meat every week.</li>
                    </ul>
                    
                    <h4>Why the fish consumption rate is very lower in Pakistan?</h4>
                    <p>In Pakistan, there are common assumptions such as the fish due to its high nutrition value is a rich energetic food and produces bodily heat when consumed. Hence, it should only be consumed in winters when heat and energy are required to keep the body warm. This is one of the common misconceptions that directly impacts on the fish consumption in Pakistan.</p>
                    <p>Additionally, people in Pakistan prefer ease and comfort when it comes to dietary habits. Fish contains small thorns that requires considerable effort to remove them before consuming. Chicken in contrast is comparatively easier than fish to consume by people of all ages.</p>
                    <p>Regardless of the accumulative nutritional value offered by the nature, people in Pakistan only consider the fish due to its taste and effectiveness against harsh winter season.</p>
                    <p>Compared to the neighboring countries, our fresh water fisheries production rate is considerably low. The availability of fresh fish in off season also makes it difficult choice for consumers.</p>
                    
                    <h4>What efforts are being made by Zaynab Fish Farm to increase the consumption of fish in Pakistan?</h4>
                    <p>We have taken up multiple initiatives to increase the consumption of fish in Pakistan such as:</p>
                    <ul>
                        <li>Introducing Sustainable Fish Farming. Through this initiative, we are trying to ensure consistent and direct supply of fresh fish to residents of nearby areas.</li>
                        <li>We are using electronic media to broadcast information regarding the importance of fish.</li>
                        <li>We have introduced the facility to place orders online to ensure the availability of fresh fish.</li>
                    </ul>
                    
                    <h4>What do experts say about consuming fish during summers? Should it be avoided during summers?</h4>
                    <p>Fish in summers is equally beneficial as in winters. In Pakistan, there is a common misconception that fish should only be consumed during the months that have the Urdu letter "ر" in their names. People believe that the fish breeds and reproduces during the months of summer and it should not be consumed.  Hence the major fish consumption in Pakistan is limited to winters and it is usually not found in market during summers.</p>
                    <p>Maintaining the freshness of fish during summers is a difficult task anyway. During summers, availability of fish as processed food or in the form of value-added products is preferred. If fresh fish is made available in the market during summers, it can help increase the consumption of fish in Pakistan.</p>
                    <p>After the monsoon season, fish lay eggs in natural water resources (Rivers, lakes etc) and it is illegal in Pakistan to fish them during this period. However, a farmed fish can be consumed in summers if its age is six months or above.</p>
                    
                    <h4>Which type of fish are you farming and what is its nutritional value?</h4>
                    <p>We are farming Pangasius Fish. From a nutritional point of view, 100 grams of Pangasius fish contains:</p>
                    <ul>
                        <li>92 Calories.</li>
                        <li>15 Grams of Protein.</li>
                        <li>3.5 Grams of Fat.</li>
                        <li>80mg of Cholesterol.</li>
                    </ul>
                    
                    <h4>Why do we feel thirsty after consuming fish?</h4>
                    <p>We feel thirsty after consuming the fish because of the way it is prepared. During the marination process, the fish meat receives huge amount of spices and later while deep frying it absorbs vegetable oil in abundance. It is not the fish but the combined effect of spices and frying oil that makes you feel thirsty when you consume fish.</p>
                    
                    <h4>What is the correlation between fish and vitiligo disease?</h4>
                    <p>There is no correlation between fish and vitiligo disease. It is a hereditary disease which is transferred genetically from ancestors. Scientific research has proven that consumption of dairy products including milk right after having fish does not cause vitiligo at all.</p>
                    
                    <h4>Is the consumption of Pangasius fish harmful for health?</h4>
                    <p>The simple answer is No. Any fish consumed in human diet in any part of the world is not harmful for health. However, the following factors can make it detrimental to human health:</p>
                    <ul>
                        <li>Farming of fish in polluted water.</li>
                        <li>Feeding contaminated feed to the fish.</li>
                        <li>Catching and transporting fish in a reckless manner.</li>
                        <li>Careless handling; not keeping the fish in cold storage.</li>
                    </ul>
                    <p>On every stage of fish farming and it’s supply chain, human supervision is involved.  If the processes are conducted with due diligence then no fish would ever become harmful to human health.</p>
                    <p>Alhamdulillah, at Zaynab Fish Farm, we take pride in performing all steps – from farming to delivery - with utmost dedication. We take great care to ensure that you and your love ones receive best quality fish meat throughout the season.</p>
                ',
        ];

        $blog2 = [
            'language' => 'UR',
            'title' => 'مچھلی کھانے سے متعلق سوالات',
            'slug' => $this->getSlug('مچھلی کھانے سے متعلق سوالات', 'UR'),
            'author_id' => 1,
            'content' => '
                <h4>ہمیں مچھلی کیوں کھانی چاہئے؟</h4>
                <p>مچھلی غذائی اعتبار سے اپنے آپ میں قدرت کا انمول تحفہ ہے جوکہ اعلی پروٹین، آیوڈین اور کئی اہم وائٹامنز و منرلز کا مرکب ہے۔ اسکے علاوہ مچھلی کا گوشت دیگر اقسام کے گوشت کے مقابلہ میں جلدی سے ہضم ہوجاتا ہے۔</p>
                
                <h4>مچھلی کا خوراک کے طور پر استعمال کیوں ضروری ہے؟</h4>
                <p>مچھلی کی غذائی اہمیت کے پیش نظر یہ دیکھا گیا ہے کہ خوراک میں مچھلی کا باقاعدہ استعمال انسانی نشونما، دماغی صحت بڑھانے، ذہنی دباو کم کرنے، وٹامن ڈی کے حصول میں، زیابطیس کے اثرات کو کم کرنے، بچوں میں استھما کے مسائل کو کم کرنے، بڑھاپے میں بینائی کی حفاظت اور نیند میں بہتری کے لیئے نہائیت موثر ہے۔</p>
                <p>مچھلیوں کا ایک خاص گروہ جنہیں ہم “موٹی مچھلیوں” کے گروہ کے طور پہ جانتے ہیں، کے باقاعدہ استعمال سے دل کے عارضہ کو ختم کرنے میں کافی حد تک مدد ملتی ہے۔</p>
                
                <h4>مچھلی کا استعمال کب کرنا چاہئے اور ایک صحت مند انسان کو اپنی غذائی ضروریات کے پیش نظر مچھلی کب اور کتنی مقدار میں کھانی چاہئے؟ </h4>
                <p>مچھلی کا سردی میں استعمال بہت مفید رہتا ہے۔ اسکے علاوہ بدن میں اگر ضعف محسوس ہو تب بھی مچھلی کا استعمال بہت مفید رہتا ہے۔ زخموں کی بھروائی کے لیئے مچھلی بہترین غذاء ہے۔ جن خواتین کا زچگی کے دوران “سی سیکشن” ہو، انکے لیئے “البومن” سے بھرپور “سول مچھلی” کا استعمال مفید رہتا ہے۔</p>
                <p>ایک صحتمند انسان کو عالمی ادارہ خوراک کے دیئے گئے ضابطہ کے مطابق سالانہ بیس کلو گرام مچھلی کھانی چاہئے۔ ہفتہ بھر میں ایک فرد کو کم از کم ایک پاو مچھلی ضرور کھانی چاہئے۔ </p>
                
                <h4>پاکستان میں مچھلی کی کھپت کیوں کم ہے؟</h4>
                <p>پاکستان میں یہ تصور عام ہے کہ مچھلی نہائیت گرم یا طاقتور (مقوی) شے ہے۔ لہذا اسکا استعمال صرف سردی کو دور کرنے کے لیئے کرنا چاہئے جو کہ سراسر غلط اور بے بنیاد مفروضہ ہے۔ اس کے علاوہ ہم کھانے میں سہولت پسندی کا شکار ہیں۔ مچھلی کے مقابلے میں مرغی کا گوشت سارا سال ملتا ہے اور کھانے میں بھی کوئی دقت پیش نہی آتی۔ بچے، بوڑھے یکساں طور پر باآسانی مرغی کا گوشت کھا سکتے ہیں جبکہ مچھلی کے گوشت میں کانٹا ہونے کے سبب کھانے میں کافی محنت درکار رہتی ہے۔ </p>
                <p>بازار میں تازہ مچھلی کی عدم فراہمی اور معاشرے میں مچھلی سے متعلق غلط مفرضے بھی مچھلی کی کم کھپت کا سبب ہیں۔ ہم مچھلی کو صرف زائقہ اور سردی بھگانے لیئے استعمال کرتے ہیں قطع نظر اسکے کہ مچھلی کا استعمال غذائی اعتبار سے کتنا ضروری ہے۔</p>
                <p>ہمسایہ ممالک کی نسبت ہماری مچھلی کی مجموعی پیداوار بھی کم ہے اور سارا سال تازہ مچھلی کی فراہمی بھی ایک الگ موضوع ہے۔</p>
                
                <h4>پاکستان میں مچھلی کی کھپت بڑھانے کے لیئے آپ کیا کر رہے ہیں؟</h4>
                <p>اس سلسلہ میں سب سے پہلے ہم نے زمہ دارانہ ماہی پروری کا آغاز کیا اور اہل علاقہ کو براہ راست تازہ مچھلی کی فراہمی کو یقنی بنایا۔ الیکٹرانک میڈیا کے توسط ہم آپ تک مچھلی کی افادیت سے متعلق معلومات پہنچا رہے ہیں اور تروتازہ مچھلی کی فراہمی کے لیئے آن لائن آرڈر کی سہولت بھی متعارف کرائی جاچکی ہے۔</p>
                
                <h4>مچھلی کا گرمی میں استعمال کیسا ہے؟ کیا مچھلی گرمی میں نہی کھانی چاہئے؟</h4>
                <p>مچھلی گرمی ہو یا سردی ہر موسم میں یکساں مفید ہے۔ ہمارے ہاں یہ بات مشہور ہے کہ مچھلی صرف “ر” والے مہینوں میں ہی کھانی چاہئے اور گرمی کے مہینے مچھلی کی نشو ونما (افزائش نسل) کے ہوتے ہیں اس لیئے مچھلی کا استعمال سردی کے دنوں تک محدود ہوکر رہ گیا ہے۔ بازار میں گرمی کے دنوں میں عموما مچھلی دکھائی بھی نہی دیتی اور اگر مل بھی جائے تو اسکی تازگی کو برقرار رکھنا بھی ایک مسئلہ ہے۔</p>
                <p>گرمی کے موسم میں مچھلی کی دستیابی کے لیئے اسکا پروسیسڈ ہونا اور ویلیو ایڈڈ مصنوعات کی صورت میں دستیاب ہونا زیادہ موزوں ہے۔ بازار میں زندہ مچھلی کی دستیابی ممکن بنانا پاکستان میں مچھلی کی کھپت بڑھانے کے لیئے اہم اقدام ثابت ہوسکتےہیں۔ </p>
                <p>مچھلیاں گرمی کے دنوں میں مون سون کے بعد قدرتی پانی کے زخیروں میں پونگ (بچہ مچھلی) پیدا کرتی ہیں اور انکا شکار کرنا غیر قانونی ہے لیکن ایسی مچھلی جو کہ فارمڈ ہو اور اسکی عمر چھ ماہ سے زائد ہوچکی ہو اسے گرمی کے دنوں میں بھی کھایا جاسکتا ہے۔</p>
                
                <h4>آپ کونسی مچھلی پال رہے ہیں اور اسکی غذائی اہمیت کیا ہے؟</h4>
                <p>ہم پنگاسیس مچھلی پال رہے ہیں اور غذائی اعتبار سے اس مچھلی کے ۱۰۰ گرام گوشت سے آپکو ۹۲ کیلوریز، ۱۵ گرام پروٹین، ۳۔۵ گرام چربی اور ۸۰ ملی گرام کولیسٹرول حاصل ہوتا ہے۔</p>
                
                <h4>مچھلی کھانے سے پیاس کیوں لگتی ہے؟</h4>
                <p>ہمارے ہاں مچھلی کھانے کا مروجہ نظام پیاس لگنے کی اصل وجہ ہے۔ ہم مچھلی کو ڈھیر سارا مصالحہ لگاتے ہیں اور پھر اسے تیل مین تلتے ہیں۔ پھر وہی تیل مچھلی کے گوشت میں جذب ہوجاتا ہے۔ مصالحہ اور تیل مل کر پیاس لنگے کا سبب بنتے ہیں۔</p>
                
                <h4>مچھلی اور پھلبہری کا کیا تعلق ہے؟ </h4>
                <p>مچھلی اور پھلبہری میں کوئی تعلق نہی ہے۔ یہ ایک موروثی بیماری ہے جو کہ وراثتی طور پہ منتقل ہوتی ہے۔ سائنسی تحقیق سے یہ بات یکسر غلط ثابت ہوچکی ہے کہ مچھلی کھانے سے یا مچھلی کھانے کے فوراََ بعد دودھ پینے سے پھلبہری ہوتی ہے۔</p>
                
                <h4>کیا پنگاسیس مچھلی صحت کے لیئے مضر ہے؟</h4>
                <p>نہیں۔ کوئی بھی مچھلی جو کہ عموماََ دنیا میں بطور خوراک استعمال ہورہی ہے وہ صحت کے لیئے بذات خود مضر نہی ہوتی۔ اس کے مضر صحت ہونے میں مندرجہ زیل عوامل کا دخل رہتا ہے۔ </p>
                <ul>
                    <li>پانی کا آلودہ ہونا۔</li>
                    <li>دی جانے والی خوراک کا آلودہ ہونا۔</li>
                    <li>مچھلی پکڑنے اور اسکی ترسیل کا غیر مناسب طریقہ کار </li>
                    <li>مچھلی کے گوشت کو درست انداز سے ٹھنڈی جگہ پر محفوظ نہ کرنا۔</li>
                </ul>
                <p>مچھلی کی پیداوار سے لے کر اس کی ترسیل تک کے ساراے معاملات انسانی انتظام کے زیر اثر ہوتے ہیں۔ اگر یہ معاملات مکمل زمہ داری کے ساتھ سر انجام پائینں تو کوئی بھی مچھلی مضر صحت نہ ہو۔ </p>
                <p>الحمدللہ ہم نے مچھلی کی فارمنگ سے لیکر آپ احباب تک رسائی کے تمام اقدامات کو زمہ داری سے سرانجام دیا ہے تاکہ آپ تک بہترین مچھلی کا گوشت مہیا کیا جاسکے۔ </p>
            '
        ];

        $blog3 = [
            'language' => 'EN',
            'title' => 'Fish Farming and Us',
            'slug' => $this->getSlug('Fish Farming and Us'),
            'author_id' => 1,
            'content' => '
                <p>The fish farming profession deserves much appreciation because of the value it brings to the society and it is quite a simple job too. In order to set up a fish farm you need to perform the following activities:</p>
                <ul>
                    <li>Choose a suitable place and dig up ponds where fish will be farmed.</li>
                    <li>Arrange for and fill up the ponds with water of optimum quality and quantity.</li>
                    <li>Get fish seed from the nearest hatchery and stock in to the ponds.</li>
                    <li>Arrange suitable feed for the fish.</li>
                </ul>
                
                <p>Another important task is to observe the water parameters and regularly change the water in the ponds if required. Fluctuations in weather conditions and addition of impurities in water including fish feed can alter the water parameters necessary for the growth of fish. Hence, water needs to be changed frequently to maintain the optimal levels of water parameters such as Dissolved Oxygen (DO) and pH etc.</p>
                <p>Once the fish has been ready to harvest, a large number of fishermen are available to harvest and process the fish. The presence of multiple fish markets across all major cities generates high demand for the fish. These markets help in the rapid sale of farmed fish.</p>
                <p>In short, fish farming does not require much of effort on the farmers’ part. When compared to other livestock rearing, fish farming requires comparatively less effort and time. This low-operational nature of fish farming provides the flexibility for the farmers to be engaged in multiple other tasks simultaneously.</p>
                
                <h4>Extent of Commercial Farming on a Broad Range</h4>
                <p>In Pakistan, fish farming is propagating on low to medium range scale. It is due to this reason that in Pakistan fish farming has not emerged as sole primary business rather as a secondary source of income. One of the basic reasons for fish farming’s relegation to secondary occupation is due to the prolonged life cycle of farming season and challenges in its supply chain. The time from nursery to production  extends over eight to ten months. This extended duration causes a delay in return on investment.</p>
                <p>In order to broaden the scope of fish farming, a simple rule of thumb is the direct correlation between the farm production capacity and its revenue. This means achieving high density stocking per acre will broaden the opportunities for this business to excel. This rule should be considered by the new Fish farmers. In order to increase the pond stocking capacity, such variants of fish have been introduced in Pakistan that do not require a lot of space to be farmed.</p>
                
                <h4>What is the Role of Zaynab Fish Farm?</h4>
                <p>In Pakistan, mostly the farming is being done for a herbivorous variant of fish which belongs to the Indian Carps (common carps) family. After common carps, the Talapia fish is the second highest farmed fish in Pakistan. Zaynab Fish Farm envisions to introduce new variants of fish that have a higher production rate per acre and in addition to their nutritional value, these new variants should be free from the fish thorns. In order to practically achieve our objectives, we adopted Catfish culture and have introduced Pangasius fish in Pakistan which belongs to the family of Catfish.</p>
                
                <h4>Pangasius Fish</h4>
                <p><em>Pangasius</em> is a boneless prime fish and due to its high consumption and demand, the fish suppliers in Pakistan are importing it from Thailand, Indonesia, Vietnam and Malaysia. Since January 2019, we are importing the Pangasius Fish Seed from Thailand and successfully cultured hormone free naturally raised (organic) high quality fish.</p>
                <p>The fish (Pangasius) is really good in taste and its meat can be used in making <span class="font-weight-bold font-italic">Fish Fingers</span> and famous <span class="font-italic">Japanese</span> recipe <span class="font-weight-bold font-italic">Sushi</span>. You can cook it the way you like following the traditional fish recipes, grill or bake it to get maximum of its nutritional value.</p>
            '
        ];

        $blog4 = [
            'language' => 'UR',
            'title' => 'ہم اور ماہی پروری',
            'slug' => $this->getSlug('ہم اور ماہی پروری', "UR"),
            'author_id' => 1,
            'content' => '
                <p>ماہی پروری (مچھلی فارمنگ) نہائیت سہل اور لائق تحسین پیشہ ہے۔ اس مقصد کے حصول کے لیئے آپکو:</p>
                <ul>
                    <li>مطلوبہ جگہ کا انتخاب کرکے تالاب کھدوانے ہوتے ہیں۔</li>
                    <li>مناسب پانی کا بندوبست کرنا ہوتا ہے۔</li>
                    <li>بچہ مچھلی (پونگ) ہیچری سے خرید کر تالابوں میں ڈالنا ہوتا ہے۔</li>
                    <li>مچھلی کی مناسب خوراک کا بندوبست کرنا ہوتا ہے۔</li>
                </ul>
                <p>اس کے علاوہ موسمی تبدیلیوں (تغیرات) اور تالابوں میں ڈالے جانے والے اجزاء بشمول خوراک کے تناظر میں پانی کے خواص (واٹر پیرامیٹرز) مطلوبہ سطح پہ برقرار رکھنے کے لیے پانی کی وقتاََ فوقتاََ جانچ اور تبدیلی کرنا ہوتی ہے۔</p>
                <p>مچھلی کی پکڑوائی کے لیئے ماہی گیر حضرات کی دستیابی رہتی ہے جبکہ مچھلی کی فروخت کے لیئے بڑے شہروں میں منڈیوں کی موجودگی مچھلی کی فروخت میں معاون ثابت ہوتی ہے۔ </p>
                <p>الغرض، ماہی پروری کے دوران آپ کو خود سے بہت کچھ کرنے کی ضرورت نہی ہوتی اور دیگر لائیو اسٹاک کے ساتھ موازنہ کیا جائے ماہی پروری پہ بہ نسبت کم محنت درکار ہوتی ہے۔ یہی وجہ ہے کہ آپ بیک وقت ماہی پروری کے ساتھ دیگر کام بھی بآسانی سر انجام دے سکتے ہیں۔ </p>
                
                <h4>وسیع پیمانے پر کمرشل فارمنگ کی سطح</h4>
                <p>پاکستان میں مچھلی فارمنگ کم ان پٹس سے لیکر اوسط سطح کی ان پٹس کے ساتھ فروغ پارہی ہے۔ یہی وجہ ہے کہی یہ شعبہ بنیادی کاروبار کی بجائے اضافی کاروبار کے طور پر ابھر کر سامنے آیا ہے۔ ماہی پروری کو بنیادی کاروبار کی حیثیت حاصل نہ ہونے ایک وجہ اس کا طویل دورانیہ ہے جو کہ آٹھ سے دس ماہ پر محیط ہے جو کہ سرمایہ کاری کے عوض نفع کے حصول میں انتظار کا سبب بنتا ہے۔ </p>
                <p>اس کاروبار کا پیمانہ وسیع کرنے کا بنیادی اصول پیداوار اور آمدنی کا راست متناسب ہونا ہے یعنی جتنی زیادہ پیداوار ہوگی اتنی ہی زیادہ آمدنی حاصل ہوگی۔ لہذا اس اصول کو مد نظر رکھتے ہوئے اس کاروبار کو اختیار کیا جائے۔ گزشتہ چند سالوں سے پاکستان میں ایسی مچھلیوں کی فارمنگ متعارف کرائی گئی ہے جو کہ کم جگہ میں بھی زیادہ تعداد میں پالی جاسکتی ہیں۔ </p>
                
                <h4>ہم کیا کر رہے ہیں؟ </h4>
                <p>پاکستان میں اس وقت سب سے زیادہ کارپ خاندان سے تعلق رکھنے والی سبزی خور مچھلیوں کی افزائش کی جارہی ہے جبکہ دوسرے نمبر پہ تلاپیہ مچھلی کی فارمنگ کی جارہی ہے۔ زینب فش فارم پہ ہمارا مقصد مچھلی کی نئی اقسام کو متعارف کرانا ہے جن کی فی ایکڑ پیداواری صلاحیت زیادہ ہو اور غذائیت کے ساتھ ساتھ ان کے گوشت میں کانٹا بھی موجود نہ ہو۔ نیز یہ کہ بازار میں انکی اچھے داموں فروخت بھی ممکن ہو چنانچہ ہم نے اس سلسلے میں کیٹ فش کلچر کو اپنایا اور کیٹ فش خاندان سے تعلق رکھنے والی پنگاسیس مچھلی کو متعارف کروایا۔ </p>
            '
        ];

        $data = [$blog1, $blog2, $blog3, $blog4];

        DB::table('blogs')->insert($data);
    }

    private function getSlug($string, $lang = "EN")
    {
        switch ($lang)
        {
            case "EN":
                return Str::slug($string);
                break;
            case "UR":
                $string = mb_strtolower(trim($string), 'UTF-8');
                // Remove multiple dashes or whitespaces or underscores
                //$string = preg_replace("/[\s-_]+/", ' ', $string);
                $string = preg_replace("/[_-\s]+/", ' ', $string);
                // Convert whitespaces and underscore to the given separator
                $string = preg_replace("/[\s_]/", "_", $string);
                return $string;
        }
    }
}
