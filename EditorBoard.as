﻿/*	Filename:	EditorBoard.as		Purpose:	Board class for the level editor		Author:		Justin Bachorik		Date:		3/21/09	*/package {		import flash.display.MovieClip;	import flash.utils.*;	import flash.xml.*;	import flash.net.*;	import caurina.transitions.Tweener;	import flash.events.*;		public class EditorBoard extends MovieClip {						// class constants here		public static const SQUARE_SIDE = 30;		public static const MOVE_TIME = .2;						// instance variables here		var mySize:Number;		var nextBoardX:Number = 0;		var nextBoardY:Number = 0;		var mySquares:Array;		var myHero:Hero;		/*var myHeroX:Number;		var myHeroY:Number;		var myGoalX:Number;		var myGoalY:Number;*/				// constructor here		public function EditorBoard(boardSize:Number):void {						// initialize variables			mySquares = new Array();						// store the arguments to the class			mySize = boardSize;						// set up the visuals			setUpBoard();					}				// function to set up the initial visual appearance of the board		private function setUpBoard():void {						// loop through all the locations, add blank squares to each one			for(var i:Number = 0; i < mySize; i++) {								// initialize a new array for the row				mySquares[i] = new Array();								for(var j:Number = 0; j < mySize; j++) {										mySquares[i][j] = new BoardSquare();					mySquares[i][j].y = nextBoardX;					mySquares[i][j].x = nextBoardY;										// add event listener for clicking on the board square					mySquares[i][j].addEventListener(MouseEvent.CLICK,handleBoardClick);										this.addChild(mySquares[i][j]);										nextBoardX += SQUARE_SIDE;				}				nextBoardY += SQUARE_SIDE;				nextBoardX = 0;			}					}	// end setUpBoard				// function to handle clicks on the board and figure out what needs to be done		private function handleBoardClick(e:Event) {						var foundIt:Boolean = false;			var i:Number;			var j:Number;			// first figure out what was clicked and preserve values of i and j to track it			for(i = 0; i < mySize; i++) {				for(j = 0; j < mySize; j++) {					if(e.target == mySquares[i][j]) {						foundIt = true;						break;					}				}				if(foundIt) break;			}								// now find out what brush is active and do the right thing based on that 			// NOTE THAT ALL ADDITIONS ARE TO j, i and not i, j--the array is flip-flopped to be x, y			var myParent:Object = LevelEditor(this.parent);			switch(myParent.getBrush()) {								case 'Hero':					addItemToBoard(new Hero(),i,j);					break;				case 'Wall':					addItemToBoard(new Wall(), i,j);					break;				case 'Empty':					addItemToBoard(new BoardSquare(),i,j);					break;				case 'Goal':					addItemToBoard(new Goal(),i,j);					break;				case 'PowerUp1':					addItemToBoard(new PowerUp(1),i,j);					break;				case 'PowerUp2':					addItemToBoard(new PowerUp(2),i,j);					break;				case 'PowerUp3':					addItemToBoard(new PowerUp(3),i,j);					break;				case 'PowerUp4':					addItemToBoard(new PowerUp(4),i,j);					break;				case 'PowerUp5':					addItemToBoard(new PowerUp(5),i,j);					break;							}					}	// end handleBoardClick				// function to add an item to the board		public function addItemToBoard(newBoardItem:Object,xPos:Number, yPos:Number) {						// if it's a hero or a goal, we need to remove the old one			if(String(newBoardItem) == '[object Hero]' || String(newBoardItem) == '[object Goal]') {				var myType:String = String(newBoardItem);				// iterate through the board, find the old one, and yank it out, replacing it with a blank				var foundIt:Boolean = false;				for(var i:Number = 0; i < mySize; i++) {					for(var j:Number = 0; j < mySize; j++) {						if(myType == String(mySquares[i][j])) {							foundIt = true;							break;						}					}					if(foundIt) break;				}				if(foundIt) {					// 'reset' the square					mySquares[i][j] = new BoardSquare();					mySquares[i][j].x = i * SQUARE_SIDE;					mySquares[i][j].y = j* SQUARE_SIDE;					this.addChild(mySquares[i][j]);					mySquares[i][j].addEventListener(MouseEvent.CLICK,handleBoardClick);				}			}						// 'reset' the square			mySquares[xPos][yPos] = new BoardSquare();			mySquares[xPos][yPos].x = xPos * SQUARE_SIDE;			mySquares[xPos][yPos].y = yPos * SQUARE_SIDE;			this.addChild(mySquares[xPos][yPos]);			mySquares[xPos][yPos] = newBoardItem;			this.addChild(mySquares[xPos][yPos]);			mySquares[xPos][yPos].x = xPos * SQUARE_SIDE;			mySquares[xPos][yPos].y = yPos * SQUARE_SIDE;			// add event listener for clicking on the board square			mySquares[xPos][yPos].addEventListener(MouseEvent.CLICK,handleBoardClick);								}  // end addItemToBoard				// function to retrieve an XML representation of the current level		public function getLevelXml():XML {						var myLevelXml:XML = <level />;			var tmpChild:XML;			// get the walls, powerups, and goal, and hero			for(var i:Number = 0; i < mySize; i++) {				for(var j:Number = 0; j < mySize; j++) {					if( '[object Wall]' == String(mySquares[i][j])) {						tmpChild = <el />;						tmpChild.@type = 'wall';						tmpChild.@xPos = i;						tmpChild.@yPos = j;						myLevelXml.appendChild(tmpChild);					}					if( '[object PowerUp]' == String(mySquares[i][j])) {						tmpChild = <el />;						tmpChild.@type = 'powerup';						tmpChild.@xPos = i;						tmpChild.@yPos = j;						tmpChild.@strength = mySquares[i][j].getStrength();						myLevelXml.appendChild(tmpChild);					}					if( '[object Goal]' == String(mySquares[i][j])) {						tmpChild = <el />;						tmpChild.@type = 'goal';						tmpChild.@xPos = i;						tmpChild.@yPos = j;						myLevelXml.appendChild(tmpChild);					}					if( '[object Hero]' == String(mySquares[i][j])) {						tmpChild = <el />;						tmpChild.@type = 'hero';						tmpChild.@xPos = i;						tmpChild.@yPos = j;						myLevelXml.appendChild(tmpChild);					}				}			}						return myLevelXml;					}					}	// end class EditorBoard	}	// end package