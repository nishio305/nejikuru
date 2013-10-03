<?php /* Smarty version 2.6.26, created on 2013-10-02 19:04:11
         compiled from /home/prograph2v1y/public_html/subdomain/nejikuru//data/Smarty/templates/default/frontparts/bloc/membership_input.tpl */ ?>
<div id="container">
			<div id="crumb">
				<div id="icon"></div>
                <div id="crumb_ch"><a href="">ホーム</a> &gt; 会員登録フォーム</div>
            </div>
            
            <div id="content_title"><h3>会員登録フォーム</h3></div>
            
            <div id="contact_completion">
           	  <div id="margin-left">
            		<div id="member_registration_menu">
                    	<section id="member_registration_menu_01_on"></section>
                        <section id="right_arrow"></section>
                        <section id="member_registration_menu_02"></section>
                        <section id="right_arrow"></section>
                        <section id="member_registration_menu_03"></section>
                    </div>
                    
                <div id="legend">ネジクルでオンラインショッピングをご利用いただくためには、「会員登録」が必要です。<br>
                会員登録をしていただくと注文履歴管理やお気に入り登録などの会員専用機能がご利用になれます。</div>
            		
                <div id="signup_confirmation">お客様情報のご入力</div>

				<div class="inquiry01">必要事項をご入力の上、「入力内容を確認する」ボタンをクリックしてください。<font color="#FF0000">[必須]</font>は必ずご入力ください。</div>
                    
                    <table border="0" cellspacing="0" cellpadding="0" id="signup_confirmation_table">
                        <tr>
                            <th id="signup_th02">ログインID <font color="#FF0000">[必須]</font></th>
                            <td id="txt_11"><input type="text" name="name" size="25">　(半角英数4～20桁以内でご入力ください。ログイン時に必要になります。)</td>
                        </tr>
                        <tr>
                            <th id="signup_th02">パスワード <font color="#FF0000">[必須]</font></th>
                            <td id="txt_11"><input type="text" name="name" size="25">　(半角英数4～20桁以内でご入力ください。ログイン時に必要になります。)</td>
                        </tr>
                        <tr>
                          <th id="signup_th02">パスワード(再入力) <font color="#FF0000">[必須]</font></th>
                          <td><input type="text" name="name" size="25"></td>
                        </tr>
                        <tr>
                            <th id="signup_th02">会社名</th>
                            <td id="txt_11"><input type="text" name="name" size="42">　(法人格も含めてご入力ください。)　例:株式会社ツルガ</td>
                        </tr>
                        <tr>
                          <th id="signup_th02">会社名(フリガナ)</th>
                          <td id="txt_11"><input type="text" name="name" size="42">　(全角カタカナ入力、法人格は不要です。)　例:ツルガ</td>
                        </tr>
                        <tr>
                          <th id="signup_th02">お名前 <font color="#FF0000">[必須]</font></th>
                          <td id="txt_11"><input type="text" name="name" size="42">　例:敦賀太郎</td>
                        </tr>
                        <tr>
                          <th id="signup_th02">お名前(フリガナ) <font color="#FF0000">[必須]</font></th>
                          <td id="txt_11"><input type="text" name="name" size="42">　(全角カタカナ入力)　例:ツルガタロウ</td>
                        </tr>
                        <tr>
                          <th id="signup_th02">部署</th>
                          <td id="txt_11"><input type="text" name="name" size="42">　例:第一営業部</td>
                        </tr>
                        <tr>
                          <th id="signup_th02">役職</th>
                          <td id="txt_11"><input type="text" name="name" size="42">　例:部長</td>
                        </tr>
                        <tr>
                          <th id="signup_th03">業種</th>
                          <td id="txt_11">
                          	大分類名　 <select name="data[UserAddForm][m_gyoshu1_id]" style="width:48%" >
                                <option value="">大分類を選択</option>
                                <option value="1">農業，林業</option>
                                <option value="2">漁業</option>
                                <option value="3">鉱業，採石業，砂利採取業</option>
                                <option value="4">建設業</option>
                                <option value="5">製造業</option>
                                <option value="6">電気・ガス・熱供給・水道業</option>
                                <option value="7">情報通信業</option>
                                <option value="8">運輸業，郵便業</option>
                                <option value="9">卸売業，小売業</option>
                                <option value="10">金融業，保険業</option>
                                <option value="11">不動産業，物品賃貸業</option>
                                <option value="12">学術研究，専門・技術サービス業</option>
                                <option value="13">宿泊業，飲食サービス業</option>
                                <option value="14">生活関連サービス業，娯楽業</option>
                                <option value="15">教育，学習支援業</option>
                                <option value="16">医療，福祉</option>
                                <option value="17">複合サービス事業</option>
                                <option value="18">サービス業（他に分類されないもの）</option>
                                <option value="19">公務（他に分類されるものを除く）</option>
                                </select> (お客様の業種を教えてください。)<br>
                             	 中分類名　
                                  <select name="data[UserAddForm][m_gyoshu2_id]">
        <option value="">中分類を選択</option>
        </select><br>
                                  小分類名　
                                  <select name="data[UserAddForm][m_gyoshu3_id]">
        <option value="">小分類を選択</option>
        </select>
							</td>
                        </tr>
                        <tr>
                         	 <th id="signup_th01">性別 <font color="#FF0000">[必須]</font></th>
                         	 <td>
                          	<input type="radio" name="" value="man">男性
　　　						<input type="radio" name="hyouka" value="woman">女性
						 	 </td>
                        </tr>
                        <tr>
                          <th id="signup_th02">生年月日 <font color="#FF0000">[必須]</font></th>
                          <td>
                            <select name="">
                                <option value=""></option>
                                <option value="1960">1960</option>
                                <option value="1961">1961</option>
                                <option value="1962">1962</option>
                                <option value="1964">1964</option>
                                <option value="1965">1965</option>
                                <option value="1966">1966</option>
                                <option value="1967">1967</option>
                                <option value="1968">1968</option>
                                <option value="1969">1969</option>
                                <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                                <option value="1975">1975</option>
                                <option value="1976">1976</option>
                                <option value="1977">1977</option>
                                <option value="1978">1978</option>
                                <option value="1979">1979</option>
                                <option value="1980">1980</option>
                                <option value="1981">1981</option>
                                <option value="1982">1982</option>
                                <option value="1983">1983</option>
                                <option value="1984">1984</option>
                                <option value="1985">1985</option>
                                <option value="1986">1986</option>
                                <option value="1987">1987</option>
                                <option value="1988">1988</option>
                                <option value="1989">1989</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                                <option value="1998">1998</option>
                                <option value="1999">1999</option>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                </select>年
                            <select name="">
                                <option value=""></option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                </select>月
                                                <select name="data[UserAddForm][birthday_day]" id="UserAddFormBirthdayDay">
                                <option value=""></option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>日
                          </td>
                        </tr>
                        <tr>
                          <th id="signup_th04">ご住所 <font color="#FF0000">[必須]</font></th>
                          <td id="txt_11">
                          
                                <table id="address_form" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td colspan="2">〒
                                              <input name="" type="text" id="" style="width:80px">
                                              
                                              <button type="button" style="width:120px;" onclick="">郵便番号検索</button>
                                              
                                              （半角数字入力。ハイフン抜きでご入力ください。例：5770056<br />
                                              ご入力いただき、郵便番号検索をクリックすると都道府県、市区町村が表示されます。
                                                                                            </td>
                                            </tr>
                                            <tr>
                                              <td colspan="2" id="notes">
                                              	<ul>
                                                	<li><a href="http://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号検索サイト</a>
                                                    </li>
                                                    <li><a href="/shopping/pages/nk/nk8" target="_blank">海外発送のお客様はこちらをご覧ください</a></li>
                                                </ul>
                                              
                                                                                            </td>
                                            </tr>
                                            <tr>
                                              <td>都道府県</td>
                                              <td>
                                                <select name="data[UserAddForm][m_prefecture_id]" id="UserAddFormMPrefectureId">
                                <option value="">都道府県を選択</option>
                                <option value="1">北海道</option>
                                <option value="2">青森県</option>
                                <option value="5">秋田県</option>
                                <option value="3">岩手県</option>
                                <option value="4">宮城県</option>
                                <option value="6">山形県</option>
                                <option value="7">福島県</option>
                                <option value="13">東京都</option>
                                <option value="14">神奈川県</option>
                                <option value="11">埼玉県</option>
                                <option value="12">千葉県</option>
                                <option value="8">茨城県</option>
                                <option value="10">群馬県</option>
                                <option value="9">栃木県</option>
                                <option value="19">山梨県</option>
                                <option value="15">新潟県</option>
                                <option value="20">長野県</option>
                                <option value="22">静岡県</option>
                                <option value="23">愛知県</option>
                                <option value="21">岐阜県</option>
                                <option value="24">三重県</option>
                                <option value="16">富山県</option>
                                <option value="17">石川県</option>
                                <option value="18">福井県</option>
                                <option value="27">大阪府</option>
                                <option value="26">京都府</option>
                                <option value="28">兵庫県</option>
                                <option value="29">奈良県</option>
                                <option value="30">和歌山県</option>
                                <option value="25">滋賀県</option>
                                <option value="35">山口県</option>
                                <option value="33">岡山県</option>
                                <option value="34">広島県</option>
                                <option value="31">鳥取県</option>
                                <option value="32">島根県</option>
                                <option value="37">香川県</option>
                                <option value="36">徳島県</option>
                                <option value="38">愛媛県</option>
                                <option value="39">高知県</option>
                                <option value="40">福岡県</option>
                                <option value="41">佐賀県</option>
                                <option value="42">長崎県</option>
                                <option value="43">熊本県</option>
                                <option value="44">大分県</option>
                                <option value="45">宮崎県</option>
                                <option value="46">鹿児島県</option>
                                <option value="47">沖縄県</option>
                                </select>
                                                
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>市区町村</td>
                                              <td>
                                                <input type="text" name="name" size="55">
                                                
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>番地</td>
                                              <td>
                                                <input type="text" name="name" size="55"> 例:3-2-22
                                
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>ビル名等</td>
                                              <td>
                                                <input type="text" name="name" size="55"> 例:あすなろビル9F
                                              </td>
                                            </tr>
                                          </table>
                          
                          
                          </td>
                        </tr>
                        <tr>
                          <th id="signup_th02">電話番号 <font color="#FF0000">[必須]</font></th>
                          <td id="txt_11"><input type="text" name="name" size="25">　（半角数字入力。ハイフン抜きでご入力ください。)　例：0667855551</td>
                        </tr>
                        <tr>
                          <th id="signup_th02">FAX <font color="#FF0000">[必須]</font></th>
                          <td id="txt_11"><input type="text" name="name" size="25">　（半角数字入力。ハイフン抜きでご入力ください。)　例：0667855551</td>
                        </tr>
                        <tr>
                          <th id="signup_th02">メールアドレス <font color="#FF0000">[必須]</font></th>
                          <td id="txt_11"><input type="text" name="name" size="42">　(半角数字)</td>
                        </tr>
                        <tr>
                          <th id="signup_th02">メールアドレス(確認用) <font color="#FF0000">[必須]</font></th>
                          <td id="txt_11"><input type="text" name="name" size="42">　(半角数字)</td>
                        </tr>
                </table>
                
                <div id="mail_receive"><input type="checkbox" name="" value="">ネジクルからのお得な情報メールを受け取る</div>

				<div id="buttom">
                  <div id="return_screen_bt"><a href=""></a></div>
                    
                    <div id="transmission_bt"><a href=""></a></div>
                </div>

          	</div>