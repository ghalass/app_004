import "./bootstrap";
import "flowbite";
import { initFlowbite } from "flowbite";

document.addEventListener("livewire:navigated", () => {
    // console.log("navigated");
    initFlowbite();
});
