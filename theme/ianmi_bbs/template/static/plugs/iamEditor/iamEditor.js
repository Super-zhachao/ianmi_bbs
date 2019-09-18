class IamEditor {
  constructor() {
    this.selection = window.getSelection();
  }

  init() {
    this.dom.setAttribute('contenteditable', true);
    this.dom.addEventListener('keydown', (event) = > {
      var range = this.getRange();
    if (range.commonAncestorContainer.parentNode.getAttribute('unit')) {
      var textEle = range.commonAncestorContainer;
      range.setStart(range.startContainer, 0);
      range.setEnd(range.endContainer, textEle.length);

      if ([37, 38, 39, 40].indexOf(event.keyCode) == -1) {
        range.commonAncestorContainer.parentNode.parentNode.removeChild(range.commonAncestorContainer.parentNode);
      }

      if (event.keyCode === 8) {
        return false;
      }
    }
    if (event.keyCode === 13) {
      // let elem = document.createTextNode('\n');
      // const range = document.createRange();
      // range.selectNodeContents(elem);
      // range.collapse(toStart);
      const _startOffset = this.getRange().startOffset

      // 处理：回车时，不能插入 <br> 而是插入 \n ，因为是在 pre 标签里面
      document.execCommand('insertHTML', false, '\n');
      if (this.getRange().startOffset === _startOffset) {
        // 没起作用，再来一遍
        document.execCommand('insertHTML', false, '\n');
      }
      // 阻止默认行为
      event.preventDefault();
    }
  })
    ;

    this.dom.addEventListener('paste', function (event) {
      let plainText = event.clipboardData.getData('text/plain');  // 无格式文本
      document.execCommand('insertText', false, plainText);
      event.preventDefault();
    });

    this.dom.addEventListener('blur', (event) = > {
      // 编辑框失去焦点时保存选区
      this._currentRange = this.selection.getRangeAt(0);
  })
    ;

    document.addEventListener('click', (event) = > {
      // console.log(event.target);
      if(this.dom.contains(event.target) && event.target.getAttribute('unit')
  )
    {
      var range = this.getRange();
      range.selectNodeContents(event.target)
      // var textEle = range.toString();
      range.setStart(range.startContainer, 0);
      range.setEnd(range.endContainer, 1);
    }
  })
    ;
  }

  getRange() {
    return this.selection.getRangeAt(0);
  }

  getBox(dom) {
    this.dom = dom;
    this.init();
  }

  focus() {
    // 恢复选区
    if (this._currentRange) {
      const selection = window.getSelection()
      selection.removeAllRanges()
      selection.addRange(this._currentRange)
    }
    this.dom.focus();
  }

  insertHTML(html) {
    this.focus();
    document.execCommand('insertHTML', false, html + '&#8203;');
    var range = this.getRange();
    range.setStart(range.endContainer, range.endContainer.length);
    range.setEnd(range.endContainer, range.endContainer.length);

    range.collapse(false);
  }

  toUbb() {

    let dom = this.dom.cloneNode(true);
    let code_dom = dom.querySelectorAll('[data-code]');
    for (let value of code_dom) {
      var code = value.dataset.code;
      value.parentNode.replaceChild(document.createTextNode(code), value);
    }
    return dom.innerText;
  }
}