import mx.utils.Delegate;

// Class Tooltip
class com.utilities.Tooltip {
		
	private var theTip:MovieClip;
	private var MC:MovieClip;
	private var ImageToLoad:String;
	
	
	function Tooltip(MC:MovieClip, theText:String, theImage:String , propertiesAvailable:String, propertyUrl:String, theLocation:String) {
		
		//attach ToolTip
		this.theTip = _root.attachMovie("Container_HotStop","Container_HotStop",1000);
		// set Text into MC
		this.ImageToLoad=theImage;
		
		this.theTip.txtTitle=theText;
		this.theTip.txt_location=theLocation;
		// set propertiesAvailable
		if (propertiesAvailable!="0" ) {
			this.theTip.txt_propertiesAvailable="Properties Available: "+propertiesAvailable;
			// enable link
			this.theTip.URI=propertyUrl;
			this.theTip.btn_roll.onPress=Delegate.create(this, Press_Link);
			/*
			this.theTip.btn_roll.onPress=function () {
				trace("pressed");
			}
			*/
			
		}else {
			this.theTip.btn_roll._alpha=0;
			this.theTip.txt_propertiesAvailable="Properties Available: N/A";			
		}
		// 
		this.theTip._alpha=0;
		
		//this.theTip._x = _root._xmouse - 15;
		//this.theTip._y = _root._ymouse - 35;
		
		this.theTip._visible = true;
		
		// SET POS
//		
		if (_root._xmouse>200) {	
			//trace("mayor X 160");
				//var Xpos:Number=_root._xmouse-this.theTip._width+30;
				var Xpos:Number=_root._xmouse-this.theTip.mcImage._width+30;			
			} else {
				//trace("menor X 160");
				var Xpos:Number=_root._xmouse-25;
			}
			if (_root._ymouse>300) {					
				//trace("mayor Y 250");
				//var Ypos:Number=_root._ymouse-this.theTip._height+10;
				//var Ypos:Number=_root._ymouse-this.theTip.mcImage._height+this.theTip.mc_bottom._height-100;
				var Ypos:Number=_root._ymouse-this.theTip.mcImage._height - 40;
			} else {
				//trace("menor Y 250");
				var Ypos:Number=_root._ymouse;
			}
			
			this.theTip._x = Xpos ;
			this.theTip._y = Ypos ;
			
			
		// onRollOut Remote Tip using  Delegate Class
		
		this.theTip.hand_btn.onRollOver = this.theTip.hand_btn.onReleaseOutside = Delegate.create(this, removeTip);
		//this.theTip.hand_btn.onPress =  Delegate.create(this, removeTip);
		//	this.theTip.onRollOut = this.theTip.onReleaseOutside = Delegate.create(this, removeTip);
			
		
		// Fade In the Tip
		FadeInMC(this.theTip);
		
	}
	// get Url on Press 
	public function Press_Link():Void {
		trace("URL LINK:"+this.theTip.URI);
		getURL("index.php?option=com_buildings&id="+this.theTip.URI+"&Itemid=36", "_self");
	}
	
	// fades in the tooltip
	public function FadeInMC(MC:MovieClip):Void {
		// scope var
		var scope=this;
		// fades in the MC
		MC.onEnterFrame=function () {
			this._alpha+=10;
			if(this._alpha>=100) {				
				this._alpha=100;
				delete this.onEnterFrame;
				// call the funcion Call_Image
				scope.Call_Image();
			}
			
		}
		
		
	}
	// loads the Image into the toolTip
	public function Call_Image() {
		// set the scope
		var scope=this;
		this.theTip.mcImage.loadMovie(ImageToLoad);
		this.theTip.onEnterFrame= function () {
				if (this.mcImage.getBytesLoaded()>0) {
					this.mcImage._alpha = 0;					
					// percentaje loader		
					var porcentajeX:Number = (int(this.mcImage.getBytesLoaded())/int(this.mcImage.getBytesTotal()))*100;
					this.mcPercentaje.percentaje=int(porcentajeX)+" % ";
					this.mcPercentaje._visible = false;	
					
				}
				if (this.mcImage.getBytesLoaded()>1 && this.mcImage.getBytesLoaded()>=this.mcImage.getBytesTotal()) {
					delete this.onEnterFrame;
					// call function fadeinImage
					scope.FadeInImage(this.mcImage);
				}
			
			
		}
		
		
	}
	// fades in the Image
	public function FadeInImage(MC:MovieClip):Void {
		// scope var
		var scope=this;
		MC.onEnterFrame=function () {
			this._alpha+=10;
			if(this._alpha>=100) {				
				this._alpha=100;
				delete this.onEnterFrame;				
			}
			
		}
		
		
	}
	
	// removes toolTip
	public function removeTip():Void {
		var MCRemove:MovieClip=this.theTip;
		
		this.theTip.onEnterFrame=function () {
			this._alpha-=20;
			if(this._alpha<0) {								
				delete this.onEnterFrame;
				//trace("remove:"+MCRemove);
				removeMovieClip(MCRemove);
			}
			
		}
		
	}
	

}