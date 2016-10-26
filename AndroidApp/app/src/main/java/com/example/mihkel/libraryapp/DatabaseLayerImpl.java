package com.example.mihkel.libraryapp;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by mihkel on 26.10.2016.
 */
public class DatabaseLayerImpl implements DatabaseLayer {
    @Override
    public Map<Integer, String> getSchools() {
        HashMap<Integer, String> schoolsById = new HashMap<>();
        schoolsById.put(1, "Desquartee kool");
        schoolsById.put(2, "MHG");
        schoolsById.put(3, "Viinakuradi gümnaasium");
        schoolsById.put(4, "GAGSWag");
        schoolsById.put(5, "Eluülikool");

        return schoolsById;
    }

    @Override
    public Map<Integer, String> getClasses() {
        return null;
    }

    @Override
    public Map<Integer, String> getReadingList() {
        return null;
    }
}
