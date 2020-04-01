<div class="container flex">
	<div class="left">
		<h3>
			Metadata
		</h3>
		<small>
			Basic settings for your blog
		</small>
	</div>
	<div class="right">



		<form method="POST" class="shadow">

			<label for="ti">
				Blog Title:
			</label>
			<input placeholder="Type here…" type="text" name="title" id="ti" value=\"${d.blog.title ? d.blog.title : ''}\" required>

			<label for="de">
				Description:
			</label>
			<input placeholder="A short description of your blog" type="text" name="description" id="de" minlength="6" value=\"${d.blog.description ? d.blog.description : ''}\">

			<label for="la">
				Language:
			</label>
			<input placeholder="Place the language code here (e.g. 'en') " type="text" name="language" id="la" minlength="2" maxlength="7" list="language-list" value=\"${d.blog.language ? d.blog.language : ''}\">



			<datalist id="language-list">

				<option>ab</option>
				<option>aa</option>
				<option>af</option>
				<option>ak</option>
				<option>sq</option>
				<option>am</option>
				<option>ar</option>
				<option>an</option>
				<option>hy</option>
				<option>as</option>
				<option>av</option>
				<option>ae</option>
				<option>ay</option>
				<option>az</option>
				<option>bm</option>
				<option>ba</option>
				<option>eu</option>
				<option>be</option>
				<option>bn</option>
				<option>bh</option>
				<option>bi</option>
				<option>bs</option>
				<option>br</option>
				<option>bg</option>
				<option>my</option>
				<option>ca</option>
				<option>ch</option>
				<option>ce</option>
				<option>ny</option>
				<option>zh</option>
				<option>zh-Hans</option>
				<option>zh-Hant</option>
				<option>cv</option>
				<option>kw</option>
				<option>co</option>
				<option>cr</option>
				<option>hr</option>
				<option>cs</option>
				<option>da</option>
				<option>dv</option>
				<option>nl</option>
				<option>dz</option>
				<option>en</option>
				<option>eo</option>
				<option>et</option>
				<option>ee</option>
				<option>fo</option>
				<option>fj</option>
				<option>fi</option>
				<option>fr</option>
				<option>ff</option>
				<option>gl</option>
				<option>gd</option>
				<option>gv</option>
				<option>ka</option>
				<option>de</option>
				<option>el</option>
				<option>kl</option>
				<option>gn</option>
				<option>gu</option>
				<option>ht</option>
				<option>ha</option>
				<option>he</option>
				<option>hz</option>
				<option>hi</option>
				<option>ho</option>
				<option>hu</option>
				<option>is</option>
				<option>io</option>
				<option>ig</option>
				<option>id, in</option>
				<option>ia</option>
				<option>ie</option>
				<option>iu</option>
				<option>ik</option>
				<option>ga</option>
				<option>it</option>
				<option>ja</option>
				<option>jv</option>
				<option>kl</option>
				<option>kn</option>
				<option>kr</option>
				<option>ks</option>
				<option>kk</option>
				<option>km</option>
				<option>ki</option>
				<option>rw</option>
				<option>rn</option>
				<option>ky</option>
				<option>kv</option>
				<option>kg</option>
				<option>ko</option>
				<option>ku</option>
				<option>kj</option>
				<option>lo</option>
				<option>la</option>
				<option>lv</option>
				<option>li</option>
				<option>ln</option>
				<option>lt</option>
				<option>lu</option>
				<option>lg</option>
				<option>lb</option>
				<option>gv</option>
				<option>mk</option>
				<option>mg</option>
				<option>ms</option>
				<option>ml</option>
				<option>mt</option>
				<option>mi</option>
				<option>mr</option>
				<option>mh</option>
				<option>mo</option>
				<option>mn</option>
				<option>na</option>
				<option>nv</option>
				<option>ng</option>
				<option>nd</option>
				<option>ne</option>
				<option>no</option>
				<option>nb</option>
				<option>nn</option>
				<option>ii</option>
				<option>oc</option>
				<option>oj</option>
				<option>ncu</option>
				<option>or</option>
				<option>om</option>
				<option>os</option>
				<option>pi</option>
				<option>ps</option>
				<option>fa</option>
				<option>pl</option>
				<option>pt</option>
				<option>pa</option>
				<option>qu</option>
				<option>rm</option>
				<option>ro</option>
				<option>ru</option>
				<option>se</option>
				<option>sm</option>
				<option>sg</option>
				<option>sa</option>
				<option>sr</option>
				<option>sh</option>
				<option>st</option>
				<option>tn</option>
				<option>sn</option>
				<option>ii</option>
				<option>sd</option>
				<option>si</option>
				<option>ss</option>
				<option>sk</option>
				<option>sl</option>
				<option>so</option>
				<option>nr</option>
				<option>es</option>
				<option>su</option>
				<option>sw</option>
				<option>ss</option>
				<option>sv</option>
				<option>tl</option>
				<option>ty</option>
				<option>tg</option>
				<option>ta</option>
				<option>tt</option>
				<option>te</option>
				<option>th</option>
				<option>bo</option>
				<option>ti</option>
				<option>to</option>
				<option>ts</option>
				<option>tr</option>
				<option>tk</option>
				<option>tw</option>
				<option>ug</option>
				<option>uk</option>
				<option>ur</option>
				<option>uz</option>
				<option>ve</option>
				<option>vi</option>
				<option>vo</option>
				<option>wa</option>
				<option>cy</option>
				<option>wo</option>
				<option>fy</option>
				<option>xh</option>
				<option>yi, ji</option>
				<option>yo</option>
				<option>za</option>
				<option>zu</option>

			</datalist>


			<label for="ti">
				Timezone:
			</label>
			<select name="timezone" id="ti">
				<option value="-12:00" ${d.blog.timezone === '-12:00' ? `selected=selected` : ``}>(GMT -12:00) Eniwetok, Kwajalein</option>
				<option value="-11:00" ${d.blog.timezone === '-11:00' ? `selected=selected` : ``}>(GMT -11:00) Midway Island, Samoa</option>
				<option value="-10:00" ${d.blog.timezone === '-10:00' ? `selected=selected` : ``}>(GMT -10:00) Hawaii</option>
				<option value="-09:50" ${d.blog.timezone === '-09:50' ? `selected=selected` : ``}>(GMT -9:30) Taiohae</option>
				<option value="-09:00" ${d.blog.timezone === '-09:00' ? `selected=selected` : ``}>(GMT -9:00) Alaska</option>
				<option value="-08:00" ${d.blog.timezone === '-08:00' ? `selected=selected` : ``}>(GMT -8:00) Pacific Time (US &amp; Canada)</option>
				<option value="-07:00" ${d.blog.timezone === '-07:00' ? `selected=selected` : ``}>(GMT -7:00) Mountain Time (US &amp; Canada)</option>
				<option value="-06:00" ${d.blog.timezone === '-06:00' ? `selected=selected` : ``}>(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
				<option value="-05:00" ${d.blog.timezone === '-05:00' ? `selected=selected` : ``}>(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
				<option value="-04:50" ${d.blog.timezone === '-04:50' ? `selected=selected` : ``}>(GMT -4:30) Caracas</option>
				<option value="-04:00" ${d.blog.timezone === '-04:00' ? `selected=selected` : ``}>(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
				<option value="-03:50" ${d.blog.timezone === '-03:40' ? `selected=selected` : ``}>(GMT -3:30) Newfoundland</option>
				<option value="-03:00" ${d.blog.timezone === '-03:00' ? `selected=selected` : ``}>(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
				<option value="-02:00" ${d.blog.timezone === '-02:00' ? `selected=selected` : ``}>(GMT -2:00) Mid-Atlantic</option>
				<option value="-01:00" ${d.blog.timezone === '-01:00' ? `selected=selected` : ``}>(GMT -1:00) Azores, Cape Verde Islands</option>
				<option value="+00:00" ${d.blog.timezone === '+00:00' ? `selected=selected` : ``}>(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
				<option value="+01:00" ${d.blog.timezone === '+01:00' ? `selected=selected` : ``}>(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
				<option value="+02:00" ${d.blog.timezone === '+02:00' ? `selected=selected` : ``}>(GMT +2:00) Kaliningrad, South Africa</option>
				<option value="+03:00" ${d.blog.timezone === '+03:00' ? `selected=selected` : ``}>(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
				<option value="+03:50" ${d.blog.timezone === '+03:50' ? `selected=selected` : ``}>(GMT +3:30) Tehran</option>
				<option value="+04:00" ${d.blog.timezone === '+04:00' ? `selected=selected` : ``}>(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
				<option value="+04:50" ${d.blog.timezone === '+04:50' ? `selected=selected` : ``}>(GMT +4:30) Kabul</option>
				<option value="+05:00" ${d.blog.timezone === '+05:00' ? `selected=selected` : ``}>(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
				<option value="+05:50" ${d.blog.timezone === '+05:50' ? `selected=selected` : ``}>(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
				<option value="+05:75" ${d.blog.timezone === '+05:75' ? `selected=selected` : ``}>(GMT +5:45) Kathmandu, Pokhara</option>
				<option value="+06:00" ${d.blog.timezone === '+06:00' ? `selected=selected` : ``}>(GMT +6:00) Almaty, Dhaka, Colombo</option>
				<option value="+06:50" ${d.blog.timezone === '+06:50' ? `selected=selected` : ``}>(GMT +6:30) Yangon, Mandalay</option>
				<option value="+07:00" ${d.blog.timezone === '+07:00' ? `selected=selected` : ``}>(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
				<option value="+08:00" ${d.blog.timezone === '+08:00' ? `selected=selected` : ``}>(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
				<option value="+08:75" ${d.blog.timezone === '+08:75' ? `selected=selected` : ``}>(GMT +8:45) Eucla</option>
				<option value="+09:00" ${d.blog.timezone === '+09:00' ? `selected=selected` : ``}>(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
				<option value="+09:50" ${d.blog.timezone === '+09:50' ? `selected=selected` : ``}>(GMT +9:30) Adelaide, Darwin</option>
				<option value="+10:00" ${d.blog.timezone === '+10:00' ? `selected=selected` : ``}>(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
				<option value="+10:50" ${d.blog.timezone === '+10:50' ? `selected=selected` : ``}>(GMT +10:30) Lord Howe Island</option>
				<option value="+11:00" ${d.blog.timezone === '+11:00' ? `selected=selected` : ``}>(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
				<option value="+11:50" ${d.blog.timezone === '+11:50' ? `selected=selected` : ``}>(GMT +11:30) Norfolk Island</option>
				<option value="+12:00" ${d.blog.timezone === '+12:00' ? `selected=selected` : ``}>(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
				<option value="+12:75" ${d.blog.timezone === '+12:75' ? `selected=selected` : ``}>(GMT +12:45) Chatham Islands</option>
				<option value="+13:00" ${d.blog.timezone === '+13:00' ? `selected=selected` : ``}>(GMT +13:00) Apia, Nukualofa</option>
				<option value="+14:00" ${d.blog.timezone === '+14:00' ? `selected=selected` : ``}>(GMT +14:00) Line Islands, Tokelau</option>
			</select>

			<input type="hidden" name="a" value="met">

			<footer>
				<button type="submit" class="btn">
					Save Metadata
				</button>
				${d.saved ? `
					<div class="saved">
						Metadata successfully saved!
					</div>
				` : ``}
			</footer>

		</form>



	</div>
</div>




