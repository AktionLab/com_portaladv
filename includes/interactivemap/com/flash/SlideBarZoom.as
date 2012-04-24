import mx.utils.Delegate;
import mx.transitions.Tween;
import mx.transitions.easing.*;
// SlideBar Class
class com.flash.SlideBarZoom {
	/*************************************************
	   *
	   * VARS
	   *
	   * ***********************************************/
	//configuracion
	private var orientacion:Number;
	//0: horizontal
	//!=1: vertical;
	private var prop:String;
	//"_y" ; "_x"
	private var delay:Number;
	//delay in zoom
	private var __increment:Number;
	//__increment para el UP y el DOWN
	private var BarInitialPos:Number;
	private var BarFinalPosition:Number;
	private var BarHeightTotal:Number;
	private var ContentInitialPos:Number;
	private var ContentFinalPos:Number;
	private var ContentTotalHeight:Number;
	private var __barPos:Boolean;
	private var class_state:Number;
	//0: not initialized
	//1: class started
	//2: class stoped
	//elementos visibles del scroll
	private var mask:MovieClip;
	//content mask 
	private var __mc:MovieClip;
	//mc content 
	private var Bar:MovieClip;
	// mc Bar Scroll
	private var __guideBar:MovieClip;
	public var scope:MovieClip;
	public var mouseListener:Object;
	/*************************************************
	   *
	   * GETTERS AND SETTERS
	   *
	   * ***********************************************/
	/*
	   * sets the scroll = horizontal
	   */
	public function set horizontal(bool:Boolean) {
		this.orientacion = 0;
		this.prop = "_x";
	}
	public function get horizontal():Boolean {
		return (this.orientacion == 0) ? true : false;
	}
	/*
	   * sets the scroll = vertical
	   */
	public function set vertical(bool:Boolean) {
		this.orientacion = 1;
		this.prop = "_y";
	}
	public function get vertical():Boolean {
		return (this.orientacion == 1) ? true : false;
	}
	/*
	   * easing delay var
	   */
	public function set retadoEasing(n:Number) {
		this.delay = n;
	}
	public function get retadoEasing():Number {
		return this.delay;
	}
	/*
	   * Value for Up/Down Buttons
	   */
	public function set increment(n:Number) {
		this.__increment = n;
	}
	public function get increment():Number {
		return this.__increment;
	}
	/*************************************************
	   *
	   * CONTRUCTOR CLASS
	   *
	   * ***********************************************/
	/*
	   * Constructor Class
	   *
	   * Vars:
	   *    cont: reference to container  movieclip 
	   *    mask: not use in this scroll
	   *    barr: reference to  movieclip that is the scrollbar
	   *    __guideBar: reference to movieclip 
	   */
	public function SlideBarZoom(cont:MovieClip, mask:MovieClip, barr:MovieClip, __guideBar:MovieClip, Pos:Boolean) {
		this.__mc = cont;
		this.mask = mask;
		this.Bar = barr;
		this.__barPos = Pos;
		this.__guideBar = __guideBar;
		this.class_state = 0;
		this.Init();
	}
	/*************************************************
	   *
	   * Methods
	   *
	   * ***********************************************/
	/*** PUBLIC METODS (Class Interface) ***/
	/*
	   * Init el scroll
	   */
	public function Init() {
		// if class is not initialized -> init
		if (this.class_state == 0) {
			this.class_state = 1;
			this.PosicionInicial();
			this.initConf();
			this.__mc.setMask(this.mask);
			this.DragBar();
		}
	}
	/*
	   * Stops The Scroll
	   */
	public function Stop() {
		this.GoInitialPos();
	}
	public function GoInitialPos() {
		trace("hace GoInitialPos");
		this.class_state = 0;
		this.DragBar();
		var goTweenToTop:Tween = new mx.transitions.Tween(this.Bar, "_y", mx.transitions.easing.Regular.easeOut, this.Bar._y, this.BarInitialPos, 10);
		var scope:SlideBarZoom = this;
	}
	/*
	   * Restore the Value class_state (state) to 1
	   */
	public function Continue() {
		this.class_state = 1;
	}
	/*
	   * Reset the Class
	   */
	public function Reset() {
		this.PosicionInicial();
		this.initConf();
	}
	/*
	   * Btn Move Up
	   * 
	   */
	public function Up():Void {
		this.__Move(this.__increment);
	}
	/*
	   * Btn Move Down
	   * 
	   */
	public function Down():Void {
		this.__Move(this.__increment*-1);
	}
	public function Goto(valor:Number) {
		if (valor<this.BarInitialPos) {
			this.Bar[this.prop] = this.BarInitialPos;
		} else if (valor>this.BarFinalPosition) {
			this.Bar[this.prop] = this.BarFinalPosition;
		} else {
			this.Bar[this.prop] = valor;
		}
		// - this.Bar[this.prop];
		SlideBarZoom.Real_Move(this);
	}
	/*** Private Methos of the Class ***/
	/*
	   * Set the Position of Scroll at Start
	   */
	private function PosicionInicial() {
		this.__guideBar._x = Math.floor(this.__guideBar._x);
		this.mask._x = Math.floor(this.mask._x);
		this.Bar._x = this.__guideBar._x;
		this.__guideBar._y = Math.floor(this.__guideBar._y);
		this.mask._y = Math.floor(this.mask._y);
		//
		// this.__mc._y = this.mask._y;
		if (this.orientacion == 0) {
			this.__guideBar._width = Math.floor(this.__guideBar._width);
		} else {
			this.__guideBar._height = Math.floor(this.__guideBar._height);
		}
	}
	/*
	   * Do the first Conf of the scroll
	   * orientation (horizontal/vertical)
	   */
	private function initConf(update:Boolean) {
		if (this.orientacion == 0) {
			this.BarInitialPos = this.__guideBar._x;
			this.BarFinalPosition = this.__guideBar._x+(this.__guideBar._width-this.Bar._width);
			this.ContentInitialPos = this.mask._x;
			this.ContentFinalPos = this.mask._x-(this.__mc._width-this.mask._width);
		} else {
			this.BarInitialPos = this.__guideBar._y;
			this.BarFinalPosition = this.__guideBar._y+(this.__guideBar._height-this.Bar._height)+1;
			this.ContentInitialPos = this.mask._y;
			this.ContentFinalPos = this.mask._y-(this.__mc._height-this.mask._height)-1;
		}
		this.ContentTotalHeight = ((-1)*this.ContentFinalPos)+this.ContentInitialPos;
		this.BarHeightTotal = this.BarFinalPosition-this.BarInitialPos;
		// set Bar init Position
		if (__barPos == true) {
			this.Bar._y = ((this.__guideBar._height/2)+4)/2;
			_root.mapElements.container["_allscale2"] = 100;
		}
	}
	/*
	   * Drag Bar
	   */
	private function DragBar() {
		if (this.class_state != 0) {
			var __Class:SlideBarZoom = this;
			this.Bar.onPress = function() {
				//  this.startDrag(false, this._x, __Class.BarInitialPos, this._x, __Class.BarFinalPosition);
				this.startDrag(false, 3, 3, 3, (230/2)+3);
				this._id_ = setInterval(Delegate.create(__Class, Real_Move), 1, __Class);
				//  clearInterval(this._id_);
			};
			this.Bar.onRelease = this.Bar.onReleaseOutside=function () {
				this.stopDrag();
				clearInterval(this._id_);
				this.onMouseMove = null;
			};
		}
	}
	/*
	   * Do the Movement  & check if container its inside the stage
	   *
	   */
	private static function Real_Move(__Class:SlideBarZoom) {
		var __distance:Number;
		var __ActualPos:Number;
		var __distance2:Number;
		var self:SlideBarZoom;
		var scale:Number;
		self = __Class;
		if (__Class.class_state == 1) {
			// start the drag
			clearInterval(__Class.Bar._id_);
			__Class.Bar.onMouseMove = function() {
				var right = __Class.__mc._width+__Class.__mc._x;
				var left = __Class.__mc._x;
				var top = __Class.__mc._y;
				var bottom = __Class.__mc._height+__Class.__mc._y;
				__ActualPos = __Class.Bar._y;
				__distance = ((100-((__ActualPos*100)/__Class.BarHeightTotal))/100)*__Class.ContentTotalHeight;
				// get the scale percentage
				//scale=Math.round((100-((__ActualPos*100)/__Class.BarHeightTotal)));
				scale = Math.round((160-((__ActualPos*200)/__Class.BarHeightTotal)));
				__distance = __Class.ContentInitialPos-__distance;
				//check if container its inside the stage -> if not.. change registration point
				//if (right<400) {
				if (right<500) {
					__Class.__mc.setRegistration(__Class.__mc._x-50, __Class.__mc._y);
				}
				if (top>0) {
					__Class.__mc.setRegistration(__Class.__mc._x, __Class.__mc._y+50);
				}
				if (left>0) {
					__Class.__mc.setRegistration(__Class.__mc._x+50, __Class.__mc._y);
				}
				if (bottom<500) {
					__Class.__mc.setRegistration(__Class.__mc._x, __Class.__mc._y-50);
				}
				//if (right>=400 && left<=0  && top<=0  && bottom>=400  ){ 
				if (right>=500 && left<=0 && top<=0 && bottom>=500) {
					if (scale>15) {
						__Class.__mc["_allscale2"] = scale;
					} else {
						this.startDrag(false, this._x, __Class.BarInitialPos, this._x, 79);
						__Class.__mc["_allscale2"] = 15;
					}
				} else {
					trace("DO NOTHING");
				}
			};
		}
	}
	/*
	   * Mouse Events 
	   *
	   * Get:
	   *    delta: quantity of movement
	   * Not used in this class
	   */
	private function onMouseWheel__(delta) {
		if (this.class_state == 1) {
			this.__Move(delta*5);
		}
	}
	/*
	   * Moves the bar 
	   *
	   * Get:
	   *    delta: Increment
	   */
	private function __Move(delta:Number) {
		var r:Number;
		r = this.Bar._y+(delta*-1);
		if (delta<0) {
			if (r<=this.BarFinalPosition) {
				this.Bar._y = r;
			} else {
				this.Bar._y = this.BarFinalPosition;
			}
		}
		if (delta>0) {
			if (r>=this.BarInitialPos) {
				this.Bar._y = r;
			} else {
				this.Bar._y = this.BarInitialPos;
			}
		}
		SlideBarZoom.Real_Move(this);
	}
}
