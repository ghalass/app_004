import { initFlowbite } from "flowbite";
import "./bootstrap";
import "flowbite";

document.addEventListener("livewire:navigated", () => {
    // console.log("navigated");
    initFlowbite();
});
