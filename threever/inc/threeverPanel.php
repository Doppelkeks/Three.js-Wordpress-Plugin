<div id="threeverContainer">
	<form action="">
		<div id="canvas" class="formSection">
			<h2>Canvas</h2>
			<label for="width">width (px)</label><input type="text" name="width" />	
			<label for="height">height (px)</label><input type="text" name="height" />	
		</div>
		
		<div id="mesh" class="formSection">
			<h2>Mesh</h2>
			
			<label for="filepath">Filepath</label>
			<input type="text" name="filepath" />	
		</div>
		<div id="camera" class="formSection">
			<h2>Camera</h2>
			
			<div id="cameraTypes" class="radioOpts">
				<div><input type="radio" name="cameraType" value="perspective" /> Perspective <!--<span id="persCustomBtn">[ Customize ]</span>--></div>
				<div><input type="radio" name="cameraType" value="orthographic" /> Orthographic <!--<span id="orthCustomBtn">[ Customize ]</span>--></div>
			</div>
			
			<div id="customCam">
				<div id="persCustomCam" class="formSectionOption">
					<h3><b>Perspective</b></h3>
					<label for="fov">fov</label><input type="text" name="fov" />
					<label for="aspect">aspect</label><input type="text" name="aspect" /><div class="line"></div>
					<label for="near">near</label><input type="text" name="near" />
					<label for="far">far</label><input type="text" name="far" />
					<div class="clear"></div>
				</div>
				
				<div id="orthCustomCam" class="formSectionOption">
					<h3><b>Orthographic</b></h3>
					<label for="fov">left</label><input type="text" name="left" />
					<label for="right">right</label><input type="text" name="right" />
					<label for="top">top</label><input type="text" name="top" />
					<label for="bottom">bottom</label><input type="text" name="bottom" /><div class="line"></div>
					<label for="near">near</label><input type="text" name="near" />
					<label for="far">far</label><input type="text" name="far" />
					<div class="clear"></div>
				</div>
			</div>
			
			
			<div class="advOptsBtn"><i class="advOptsIcon"></i> <b>[ more ]</b> </div>
			<div class="advOpts">
				<div id="cameraPosition" class="formSectionOption">
					<h3><b>Camera Position</b></h3>
					<label for="camPosX">x</label><input type="text" name="camPosX" />
					<label for="camPosY">y</label><input type="text" name="camPosY" />
					<label for="camPosZ">z</label><input type="text" name="camPosZ" />
					<div class="clear"></div>
				</div>	
			</div>
			
		</div>
		<div id="light" class="formSection">
			<h2>Lights</h2>
			
			<div id="lightTypes" class="radioOpts">
				<div><input type="radio" name="lightType" value="standard"/> Standard Setup </div>
				<div><input type="radio" name="lightType" value="3Point" /> 3 PointLight Setup </div>
				<div><input type="radio" name="lightType" id="customSetup" value="custom" /> <span>[ Custom Setup ]</span> </div>
			</div>
			
			<div id="customLight" class="formSectionOption">
				<h3><b>Custom Setup</b></h3>
				<div id="addLight" class="radioOpts">
					<div>
						Type
						<select name="lightForm" id="lightForm">
							<option value="point">Point</option>
							<option value="directional">Directional</option>
							<option value="spot">Spot</option>
							<option value="ambient">Ambient</option>
						</select>
						<span>[ Add Light ]</span>
					</div>
				</div>
				
				<div id="addedLights">
					
				</div>
			</div>
			
		</div>
		<div id="material" class="formSection">
			<h2>Material</h2>
			
			<div id="diffuse" class="diffuse formSectionOptionStatic">
				<h3> <b>Diffuse</b> </h3>
				<label for="tdiffuse">Texture</label>
				<input type="text" name="tdiffuse" />
				<label for="dcolor">Color</label>
				<input type="text" class="color colorInput" name="matColor"/>
			</div>
			
			<div id="specular" class="specular formSectionOptionStatic">
				<h3> <b>Specular</b> </h3>
				<label for="tspecular">Texture</label>
				<input type="text" name="tspecular" />
				<label for="scolor">Color</label>
				<input type="text" class="color colorInput" name="matColor"/><br>
				<label for="shine">Shine</label>
				<div class="valueSlider mb_slider {rangeColor:'#333333',negativeColor:'#444444', startAt:35, grid:1}" style="display:inline-block;*display:inherit;"></div>
			</div>
			
			<div id="addChannel" class="radioOpts">
				<div>
					Channel
					<select name="materialForm" id="materialForm">
						<option value="normal">Normal</option>
					</select>
					<span>[ Add Channel ]</span>
				</div>
			</div>

			<div id="normal" class="normal formSectionOption">
				<h3> <b>Normal <span>[delete]</span></b> </h3>
				<label for="tnormal">Texture</label>
				<input type="text" name="tnormal" /><br />
				<label for="strength">Strength</label>
				<div class="valueSlider mb_slider {rangeColor:'#333333',negativeColor:'#444444', startAt:16, grid:1}" style="display:inline-block;*display:inherit;"></div>
			</div>
			
			<div class="advOptsBtn"><i class="advOptsIcon"></i> <b>[ more ]</b> </div>
			<div class="advOpts">
				<input type="checkbox" name="doubleSided" value="doubleSided" />doubleSided </br>
				<input type="checkbox" name="wireframe" value="wireframe" />wireframe </br>	
			</div>	
		</div>
		
		<div id="submitFormBtn">Generate Shortcode</div>
	</form>

	<div id="lightTemplate">
		<div class="ambient lightElement formSectionOption">
			<h3> <b>AmbientLight <span>[delete]</span></b> </h3>
			<div>Color <input type="text" name="lightColor" class="color lcolor colorInput" /></div>
			<br />
		</div>
		
		<div class="directional lightElement formSectionOption">
			<h3> <b>DirectionalLight <span>[delete]</span></b></h3>
			<label for="lightPosX">x</label><input type="text" name="lightPosX" />
			<label for="lightPosY">y</label><input type="text" name="lightPosY" />
			<label for="lightPosZ">z</label><input type="text" name="lightPosZ" />
			<div>Color <input type="text" name="lightColor" class="color lcolor colorInput" /></div>
			<br />
		</div>
		
		<div class="point lightElement formSectionOption">
			<h3> <b>PointLight <span>[delete]</span></b></h3>
			<label for="lightPosX">x</label><input type="text" name="lightPosX" />
			<label for="lightPosY">y</label><input type="text" name="lightPosY" />
			<label for="lightPosZ">z</label><input type="text" name="lightPosZ" />
			<div>Color <input type="text" name="lightColor" class="color lcolor colorInput" /></div>
			<br />
		</div>
		
		<div class="spot lightElement formSectionOption">
			<h3> <b>SpotLight <span>[delete]</span></b> </h3>
			<label for="lightPosX">x</label><input type="text" name="lightPosX" />
			<label for="lightPosY">y</label><input type="text" name="lightPosY" />
			<label for="lightPosZ">z</label><input type="text" name="lightPosZ" />
			<div>Color <input type="text" name="lightColor" class="color lcolor colorInput" /></div>
			<br />
		</div>
	</div>

</div>

<div id="codeField">
	<textarea name="threeverCode" id="threeverCode" cols="30" rows="10"></textarea>
</div>