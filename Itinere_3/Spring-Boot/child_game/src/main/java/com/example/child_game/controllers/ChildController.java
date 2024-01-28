package com.example.child_game.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import com.example.child_game.models.Child;
import com.example.child_game.repositories.ChildRepository;

@Controller
public class ChildController {
    
    final ChildRepository repo;

    public ChildController(ChildRepository repo) {
        this.repo = repo;
    }

    @GetMapping("/")
    String welcome(){
        return "welcome";
    }

    @GetMapping("/children")
    String index(Model model){
        model.addAttribute("children", repo.findAll());
        return "/children/index";
    }

    @GetMapping("/children/create")
    String create(){
        return "/children/create";
    }

    @PostMapping("/children/store")
    String store(Child c){
        repo.save(c);
        return "redirect:/children";
    }

    @GetMapping("/children/show")
    String show(Model model, Long id){
        model.addAttribute("c", repo.findById(id).orElse(null));
        return "/children/show";
    }

    @GetMapping("/children/edit")
    String edit(Model model, Long id){
        model.addAttribute("c", repo.findById(id).orElse(null));
        return "/children/edit";
    }

    @PostMapping("/children/update")
    String update(Child c){
        repo.save(c);
        return "redirect:/children";
    }

    @PostMapping("/children/destroy")
    String destroy(Long id){
        repo.deleteById(id);
        return "redirect:/children";
    }
}
