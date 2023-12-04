/**
 * notification class for creating toast notification.
 * @class
 */
class Notification {
  /**
   * Creates an instance of notification.
   * @constructor
   * @param {HTMLElement} el - The container element to append notification.
   */
  constructor(el) {
    this.el = el;
    this.currentNotification = null;
  }

  /**
   * Creates a new HTML div element with the specified class.
   * @param {string} className - The class to be added to the created div element.
   * @returns {HTMLElement} - The created div element.
   */
  createDiv(className = "") {
    const el = document.createElement("div");
    el.classList.add(className);
    return el;
  }

  /**
   * Adds a text node to the specified HTML element.
   * @param {HTMLElement} el - The target HTML element.
   * @param {string} text - The text content to be added.
   */
  addText(el, text) {
    el.appendChild(document.createTextNode(text));
  }
  /**
   * Adds HTML content to the specified HTML element.
   * @param {HTMLElement} el - The target HTML element.
   * @param {string} htmlContent - The HTML content to be added.
   */
  addHTML(el, htmlContent) {
    const parser = new DOMParser();
    const parsedHtml = parser.parseFromString(htmlContent, "text/html");

    // Append all child nodes individually to avoid executing scripts
    parsedHtml.body.childNodes.forEach(node => {
      el.appendChild(node.cloneNode(true));
    });
  }
  /**
   * Creates and displays a notification with the specified parameters.
   * @param {string} title - The title of the notification.
   * @param {string} description - The description of the notification.
   * @param {number} duration - The duration of the notification in seconds. Set to 0 for indefinite.
   * @param {boolean} destroyOnClick - If true, the notification will be destroyed on click.
   * @param {function} clickFunction - The function to be executed on notification click.
   * @returns {HTMLElement} - The created notification element.
   */
  create(
    title = "Untitled notification",
    description = "",
    duration = 5,
    destroyOnClick = false,
    clickFunction = undefined,
  ) {
    /**
     * Destroys the notification.
     * @param {boolean} animate - If true, applies an animation before removal.
     */
    function destroy(animate) {
      if (animate) {
        notiEl.classList.add("out");
        notiEl.addEventListener("animationend", () => {
          notiEl.remove();
        });
      } else {
        notiEl.remove();
      }
    }

    // Create the notification elements and add content
    const notiEl = this.createDiv("noti");
    const notiCardEl = this.createDiv("noticard");
    const glowEl = this.createDiv("notiglow");
    const borderEl = this.createDiv("notiborderglow");

    const titleEl = this.createDiv("notititle");
    // this.addText(titleEl, title);
    this.addHTML(titleEl, title);

    const descriptionEl = this.createDiv("notidesc");
    // this.addText(descriptionEl, description);
    this.addHTML(descriptionEl, description);

    // Append elements to each other
    notiEl.appendChild(notiCardEl);
    notiCardEl.appendChild(glowEl);
    notiCardEl.appendChild(borderEl);
    notiCardEl.appendChild(titleEl);
    notiCardEl.appendChild(descriptionEl);

    this.el.appendChild(notiEl);

    // Transition the height of the container to the height of the visible card
    requestAnimationFrame(() => {
      notiEl.style.height =
        "calc(0.25rem + " + notiCardEl.getBoundingClientRect().height + "px)";
    });

    // Hover animation
    notiEl.addEventListener("mousemove", event => {
      const rect = notiCardEl.getBoundingClientRect();
      const localX = (event.clientX - rect.left) / rect.width;
      const localY = (event.clientY - rect.top) / rect.height;

      glowEl.style.left = localX * 100 + "%";
      glowEl.style.top = localY * 100 + "%";

      borderEl.style.left = localX * 100 + "%";
      borderEl.style.top = localY * 100 + "%";
    });

    // On click function
    if (clickFunction !== undefined) {
      notiEl.addEventListener("click", clickFunction);
    }

    // Destroy the notification on click if set
    if (destroyOnClick) {
      notiEl.addEventListener("click", () => destroy(true));
    }

    // Remove the notification after the set time if there is one
    if (duration !== 0) {
      setTimeout(() => {
        notiEl.classList.add("out");
        notiEl.addEventListener("animationend", () => {
          notiEl.remove();
        });
      }, duration * 1000);
    }

    return (this.currentNotification = notiEl);
  }
  /**
   * Updates the description of a notification.
   * @param {HTMLElement} notification - The notification element to update.
   * @param {string} newDescription - The new description to set.
   */
  updateDescription(newDescription) {
    const descriptionEl = this.currentNotification.querySelector(".notidesc");
    descriptionEl.innerHTML = "";
    this.addText(descriptionEl, newDescription);
  }
}

export default Notification;
