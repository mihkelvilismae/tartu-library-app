package com.example.mihkel.libraryapp.Activities;

import android.app.Activity;
import android.app.Dialog;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.AdapterView;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.LinearLayout;
import android.widget.NumberPicker;
import android.widget.TextView;
import android.widget.Toast;

import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.Item.Author;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.R;
import com.example.mihkel.libraryapp.Various.JsonTask;
import com.example.mihkel.libraryapp.Various.Selection;
import com.example.mihkel.libraryapp.Various.TextAutocompleteListAdapter;
import com.example.mihkel.libraryapp.Various.DatabaseManagerSingleton;
import com.example.mihkel.libraryapp.Various.URLCreator;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import static com.example.mihkel.libraryapp.Various.JsonTask.TASK_TYPE_RESULTS;

public class RecommendationActivity extends AppCompatActivity implements View.OnClickListener, ParseStringCallBackListener, AutoCompleteCallback {
//    private static final int OBJECT = 1;
//    private static final int TAG_AUTHOR = 2;
//    private static final int TAKE_PICTURE = 1;

//    private static final int YEAR_TYPE_AGE = 1;
//    private static final int YEAR_TYPE_YEAR = 2;


    public Integer visibleLevel = 0;
    public Integer activeLevel = 0;

    //    private Fragment authorFragment;
    private LinearLayout sexLayout;
    private LinearLayout previouslyLikedLayout;
    private LinearLayout authorLayout;
    private LinearLayout genreLayout;
    private LinearLayout keywordsLayout;
    private LinearLayout likesReadingLayout;
    private LinearLayout ageLayout;
    private LinearLayout languageLayout;
    private LinearLayout yearLayout;

    private Button nextButton;
    private Button resultButton;
    private Button previousButton;

    private ArrayList<Item> selectedAuthors = new ArrayList<>();
    private ArrayList<Item> authors;
    private ArrayList<Item> selectedBooks = new ArrayList<>();
    private ArrayList<Item> books;
    private ArrayList<Item> selectedKeywords = new ArrayList<>();
    private ArrayList<Item> keywords;
    private ArrayList<Item> selectedGenres = new ArrayList<>();
    private ArrayList<Item> genres;

    private TextAutocompleteListAdapter genreAdapter;
    private TextAutocompleteListAdapter authorAdapter;
    private TextAutocompleteListAdapter keywordAdapter;
    private TextAutocompleteListAdapter bookAdapter;

    AutoCompleteTextView genreAutoCompleteTextView;
    AutoCompleteTextView authorAutoCompleteTextView;
    AutoCompleteTextView keywordAutoCompleteTextView;
    AutoCompleteTextView bookAutoCompleteTextView;

    private Button sexButtonF;
    private Button sexButtonM;
    private Button likesReadingButtonY;
    private Button likesReadingButtonN;
    private Button ageButton;
    private Button startYearButton;
    private Button endYearButton;
//    private GridView ageGridView;

    Selection selection = new Selection();
    public ArrayList<Item> authorsAdapterList = new ArrayList<Item>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recommendation);

        sexLayout = (LinearLayout) findViewById(R.id.sexLayout);
        previouslyLikedLayout = (LinearLayout) findViewById(R.id.booksLayout);
        authorLayout = (LinearLayout) findViewById(R.id.authorLayout);
        genreLayout = (LinearLayout) findViewById(R.id.genreLayout);
        keywordsLayout = (LinearLayout) findViewById(R.id.keywordsLayout);
        likesReadingLayout = (LinearLayout) findViewById(R.id.likesReadingLayout);
        ageLayout = (LinearLayout) findViewById(R.id.ageLayout);
        yearLayout = (LinearLayout) findViewById(R.id.yearLayout);
        languageLayout = (LinearLayout) findViewById(R.id.languageLayout);

        nextButton = (Button) findViewById(R.id.nextButton);
        nextButton.setOnClickListener(this);

        resultButton = (Button) findViewById(R.id.resultButton);
        resultButton.setOnClickListener(this);

//        previousButton = (Button) findViewById(R.id.previousButton);
//        previousButton.setOnClickListener(this);

        sexButtonF = (Button) findViewById(R.id.sexButtonF);
        sexButtonF.setOnClickListener(this);

        sexButtonM = (Button) findViewById(R.id.sexButtonM);
        sexButtonM.setOnClickListener(this);

        likesReadingButtonY = (Button) findViewById(R.id.likesReadingY);
        likesReadingButtonY.setOnClickListener(this);

        likesReadingButtonN = (Button) findViewById(R.id.likesReadingN);
        likesReadingButtonN.setOnClickListener(this);

        ageButton = (Button) findViewById(R.id.ageButton);
        ageButton.setOnClickListener(this);

        startYearButton = (Button) findViewById(R.id.startYearButton);
        startYearButton.setOnClickListener(this);

        endYearButton = (Button) findViewById(R.id.endYearButton);
        endYearButton.setOnClickListener(this);

        handleAuthorAutocomplete();
        handleGenreAutocomplete();
        handleBookAutocomplete();
        handleKeywordsAutocomplete();

//        initToggleButtons(likes);

        hideAll();

        showToLevel(visibleLevel);

    }

    //-----------------------------------------------------------------------------------------------------------------------
    // BUTTONS start:

    // BUTTONS end
    //-----------------------------------------------------------------------------------------------------------------------
    // GENERIC text function start:
    private void removeChoiceFromSelected(Item choiceItem, Integer type) {
        switch (type) {
            case R.id.TAG_AUTHOR:
                selectedAuthors.remove(choiceItem);
                authorAdapter.add(choiceItem);
                selection.getAuthors().remove(choiceItem.getId());
                break;
            case R.id.TAG_BOOK:
                selectedBooks.remove(choiceItem);
                bookAdapter.add(choiceItem);
                break;
            case R.id.TAG_GENRE:
                selectedGenres.remove(choiceItem);
                authorAdapter.add(choiceItem);
                selection.getGenres().remove(choiceItem.getId());
                break;
            case R.id.TAG_KEYWORD:
                selectedKeywords.remove(choiceItem);
                keywordAdapter.add(choiceItem);
                selection.getKeywords().remove(choiceItem.getId());
                break;
        }
    }

    private void addChoiceToSelected(Item choiceItem, Integer type) {
        switch (type) {
            case R.id.TAG_AUTHOR:
                selectedAuthors.add(choiceItem);
                authorAdapter.remove(choiceItem);
                selection.addAuthor(choiceItem);
                break;
            case R.id.TAG_BOOK:
                selectedBooks.add(choiceItem);
                bookAdapter.remove(choiceItem);
//                selection.addAuthor((Author) choiceItem);
                break;
            case R.id.TAG_GENRE:
                selectedGenres.add(choiceItem);
                authorAdapter.remove(choiceItem);
                selection.addGenre(choiceItem);
                break;
            case R.id.TAG_KEYWORD:
                selectedKeywords.add(choiceItem);
                keywordAdapter.remove(choiceItem);
                selection.addKeyword(choiceItem);
                break;
        }
    }

    private void removeItem(View buttonView) {
        Integer itemType = (Integer) buttonView.getTag(R.id.TAG_TYPE);
        switch (itemType) {
            case R.id.TAG_AUTHOR:
                removeChoiceFromSelected((Item) buttonView.getTag(R.id.TAG_OBJECT), R.id.TAG_AUTHOR);
                drawSelectedAuthors();
                break;
            case R.id.TAG_BOOK:
                removeChoiceFromSelected((Item) buttonView.getTag(R.id.TAG_OBJECT), R.id.TAG_BOOK);
                drawSelectedBooks();
                break;
            case R.id.TAG_GENRE:
                removeChoiceFromSelected((Item) buttonView.getTag(R.id.TAG_OBJECT), R.id.TAG_GENRE);
                drawSelectedGenres();
                break;
            case R.id.TAG_KEYWORD:
                removeChoiceFromSelected((Item) buttonView.getTag(R.id.TAG_OBJECT), R.id.TAG_KEYWORD);
                drawSelectedKeywords();
                break;
        }
    }
    // GENERIC text function end.
    //-----------------------------------------------------------------------------------------------------------------------
    // AUTHOR start:

    public void handleAuthorAutocomplete() {

        authorAdapter = new TextAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.itemHashMapToItemList(DatabaseManagerSingleton.getAuthorsData()), R.id.TAG_AUTHOR);

        authorAutoCompleteTextView = (AutoCompleteTextView) findViewById(R.id.editAuthor);
        authorAutoCompleteTextView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                authorAutoCompleteTextView.setText("");
                addChoiceToSelected(book, R.id.TAG_AUTHOR);
//                toast(book.toString());
                drawSelectedAuthors();
                hideKeyboard();
            }
        });

        authorAutoCompleteTextView.setAdapter(authorAdapter);
        authorAutoCompleteTextView.setThreshold(0);
    }

    public void drawSelectedAuthors() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.authorResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedAuthors) {
            //view generation
            View theInflatedView = inflater.inflate(R.layout.result_row_with_button, null); // 2 and 3
            TextView textInRow = (TextView) theInflatedView.findViewById(R.id.textInRow);
            textInRow.setText(author.getName());
            authorResult.addView(theInflatedView);
            //remove button
            Button removeButton = (Button) theInflatedView.findViewById(R.id.removeButton);
            removeButton.setTag(R.id.TAG_TYPE, R.id.TAG_AUTHOR);
            removeButton.setTag(R.id.TAG_OBJECT, author);
            removeButton.setOnClickListener(this);
        }
    }


    // AUTHOR end:
    //-----------------------------------------------------------------------------------------------------------------------
    // BOOKS start:

    public void handleBookAutocomplete() {
        bookAdapter = new TextAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.getInstance().getGenericList(R.id.TAG_BOOK), R.id.TAG_BOOK);

        bookAutoCompleteTextView = (AutoCompleteTextView) findViewById(R.id.editBook);
        bookAutoCompleteTextView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                bookAutoCompleteTextView.setText("");
                addChoiceToSelected(book, R.id.TAG_BOOK);
//                toast(book.toString());
                drawSelectedBooks();
                hideKeyboard();
            }
        });
        bookAutoCompleteTextView.setAdapter(bookAdapter);
        bookAutoCompleteTextView.setThreshold(0);
    }

    public void drawSelectedBooks() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.bookResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedBooks) {
            View theInflatedView = inflater.inflate(R.layout.result_row_with_button, null); // 2 and 3
            TextView textInRow = (TextView) theInflatedView.findViewById(R.id.textInRow);
            textInRow.setText(author.getName());
            authorResult.addView(theInflatedView);
            Button removeButton = (Button) theInflatedView.findViewById(R.id.removeButton);
            removeButton.setTag(R.id.TAG_TYPE, R.id.TAG_BOOK);
            removeButton.setTag(R.id.TAG_OBJECT, author);
            removeButton.setOnClickListener(this);
        }
    }
    // BOOKS end:
    //-----------------------------------------------------------------------------------------------------------------------
    // GENRES start:

    public void handleGenreAutocomplete() {
        authorAdapter = new TextAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.itemHashMapToItemList(DatabaseManagerSingleton.getGenreData()), R.id.TAG_GENRE);

        genreAutoCompleteTextView = (AutoCompleteTextView) findViewById(R.id.editGenre);
        genreAutoCompleteTextView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                genreAutoCompleteTextView.setText("");
                addChoiceToSelected(book, R.id.TAG_GENRE);
//                toast(book.toString());
                drawSelectedGenres();
                hideKeyboard();
            }
        });

        genreAutoCompleteTextView.setAdapter(authorAdapter);
        genreAutoCompleteTextView.setThreshold(0);
    }

    public void hideKeyboard() {
        InputMethodManager imm = (InputMethodManager) getSystemService(Activity.INPUT_METHOD_SERVICE);
        imm.toggleSoftInput(InputMethodManager.HIDE_IMPLICIT_ONLY, 0);
    }

    public void drawSelectedGenres() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.genreResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedGenres) {
            View theInflatedView = inflater.inflate(R.layout.result_row_with_button, null); // 2 and 3
            TextView textInRow = (TextView) theInflatedView.findViewById(R.id.textInRow);
            textInRow.setText(author.getName());
            authorResult.addView(theInflatedView);
            Button removeButton = (Button) theInflatedView.findViewById(R.id.removeButton);
            removeButton.setTag(R.id.TAG_TYPE, R.id.TAG_GENRE);
            removeButton.setTag(R.id.TAG_OBJECT, author);
            removeButton.setOnClickListener(this);
        }
    }
    // GENRES end:
    //-----------------------------------------------------------------------------------------------------------------------
    // AGE start:
//    public List<String> makeAgeList() {
//        List<String> ageList = new ArrayList<>();
//        for (int i = 7; i < 99; i++) {
//            ageList.add(String.valueOf(i));
//        }
//        return ageList;
//    }
//
//    public void createAgeGrid() {
//        ageGridView = (GridView) findViewById(R.id.gridView1);
//
//		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, makeAgeList());
//
//		ageGridView.setAdapter(adapter);
//
//		ageGridView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
//			public void onItemClick(AdapterView<?> parent, View v, int position, long id) {
//			   Toast.makeText(getApplicationContext(), ((TextView) v).getText(), Toast.LENGTH_SHORT).show();
//			}
//		});
//    }
    // AGE
    //-----------------------------------------------------------------------------------------------------------------------
    // KEYWORDS start:

    public void handleKeywordsAutocomplete() {
        keywordAdapter = new TextAutocompleteListAdapter(this, 11111111, DatabaseManagerSingleton.itemHashMapToItemList(DatabaseManagerSingleton.getKeywordsData()), R.id.TAG_KEYWORD);

        keywordAutoCompleteTextView = (AutoCompleteTextView) findViewById(R.id.editKeyword);
        keywordAutoCompleteTextView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View dropdownView, int position, long id) {
                Item book = (Item) dropdownView.getTag(R.id.TAG_OBJECT);
                keywordAutoCompleteTextView.setText("");
                addChoiceToSelected(book, R.id.TAG_KEYWORD);
//                toast(book.toString());
                drawSelectedKeywords();
                hideKeyboard();
            }
        });
        keywordAutoCompleteTextView.setAdapter(keywordAdapter);
        keywordAutoCompleteTextView.setThreshold(0);
    }

    public void drawSelectedKeywords() {
        LinearLayout authorResult = (LinearLayout) findViewById(R.id.keywordResult);
        LayoutInflater inflater = LayoutInflater.from(RecommendationActivity.this); // 1
        authorResult.removeAllViews();
        for (final Item author : selectedKeywords) {
            View theInflatedView = inflater.inflate(R.layout.result_row_with_button, null); // 2 and 3
            TextView textInRow = (TextView) theInflatedView.findViewById(R.id.textInRow);
            textInRow.setText(author.getName());
            authorResult.addView(theInflatedView);
            Button removeButton = (Button) theInflatedView.findViewById(R.id.removeButton);
            removeButton.setTag(R.id.TAG_TYPE, R.id.TAG_KEYWORD);
            removeButton.setTag(R.id.TAG_OBJECT, author);
            removeButton.setOnClickListener(this);
        }
    }
    // KEYWORDS end:
    //------------------------------------------------------------------------------------------------------
    // YEAR/AGE start:

    public void showYearDialog(View v) {
        final Boolean isStartYear = (v.getId() == R.id.startYearButton);
        final Boolean isEndYear = (v.getId() == R.id.endYearButton);
        final Boolean isAge = (v.getId() == R.id.ageButton);
        final Dialog d = new Dialog(this);
        String title;

//        final Boolean isStartYearDialog = (v.getId() == R.id.startYearButton);
        if (isStartYear) {
            title = "Vali aasta:";
        } else if (isEndYear) {
            title = "Vali aasta:";
        } else //if (isAge)
        {
            title = "Vali vanus";
        }

        d.setTitle(title);
        d.setContentView(R.layout.dialog_year);
        Button set = (Button) d.findViewById(R.id.yearDialogSet);
        Button cancel = (Button) d.findViewById(R.id.yearDialogCancel);
        Button plus100 = (Button) d.findViewById(R.id.plus100);
        Button plus10 = (Button) d.findViewById(R.id.plus10);
        Button minus10 = (Button) d.findViewById(R.id.minus10);
        Button minus100 = (Button) d.findViewById(R.id.minus100);
        final NumberPicker nopicker = (NumberPicker) d.findViewById(R.id.numberPicker1);

        int year = 2016;
        nopicker.setMaxValue(year);
        nopicker.setMinValue(year - 500);

        if (isAge) {
            year = 15;
            nopicker.setMaxValue(99);
            nopicker.setMinValue(5);
        } else if (isStartYear) {
            if (selection.getYearTo() != null) {
                nopicker.setMaxValue(selection.getYearTo());
            }
            if (selection.getYearFrom() != null) {
                year = selection.getYearFrom();
            }
        } else if (isEndYear) {
            if (selection.getYearTo() != null) {
                year = selection.getYearTo();
            }
            if (selection.getYearFrom() != null) {
                nopicker.setMinValue(selection.getYearFrom());
            }
        }

        nopicker.setWrapSelectorWheel(false);
        nopicker.setValue(year);
        nopicker.setDescendantFocusability(NumberPicker.FOCUS_BLOCK_DESCENDANTS);

        set.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (isStartYear)
                    setStartYear(nopicker.getValue());
                else if (isEndYear)
                    setEndYear(nopicker.getValue());
                else if (isAge)
                    setAge(nopicker.getValue());
                d.dismiss();
            }
        });
        cancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                d.dismiss();
            }
        });

        plus10.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nopicker.setValue(nopicker.getValue() + 10);
            }
        });

        plus100.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nopicker.setValue(nopicker.getValue() + 100);
            }
        });

        minus10.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nopicker.setValue(nopicker.getValue() - 10);
            }
        });

        minus100.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nopicker.setValue(nopicker.getValue() - 100);
            }
        });


        d.show();
    }

    public void setAge(Integer age) {
        ((Button) findViewById(R.id.ageButton)).setText("Vanus: " + String.valueOf(age));
    }

    public void setStartYear(int startYear) {
        ((Button) findViewById(R.id.startYearButton)).setText("Alates " + String.valueOf(startYear));
        selection.setYearFrom(startYear);
    }

    public void setEndYear(Integer endYear) {
        ((Button) findViewById(R.id.endYearButton)).setText("Kuni " + String.valueOf(endYear));
        selection.setYearTo(endYear);
    }

    public void setSex() {

    }

    public void setLikesToRead() {

    }

    public void setLanguage() {

    }


    // YEAR/AGE end
    //----------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------
    // DRAWING FIELDS start:


    public void showSelection(Selection selection) {

    }

    private void showPreviousField() {
        visibleLevel--;
        activeLevel--;
        showToLevel(visibleLevel);
//        toast("level now: " + visibleLevel);
    }

    private void showNextField() {
        visibleLevel++;
        activeLevel++;
        showToLevel(visibleLevel);
//        toast("level now: " + visibleLevel);
    }

    public void hideAll() {
        sexLayout.setVisibility(View.GONE);
        previouslyLikedLayout.setVisibility(View.GONE);
        authorLayout.setVisibility(View.GONE);
        genreLayout.setVisibility(View.GONE);
        keywordsLayout.setVisibility(View.GONE);
        likesReadingLayout.setVisibility(View.GONE);
        ageLayout.setVisibility(View.GONE);
        yearLayout.setVisibility(View.GONE);
        languageLayout.setVisibility(View.GONE);
    }

    public void showToLevel(int level) {
//        if (level >= 0)
//            showAgeField();
//        if (level >= 1)
//            showSexField();
//        if (level >= 2)
//            showLikesReadingField();
        if (level >= 0)
            showLanguageField();
        if (level >= 1)
            showYearField();
        if (level >= 2)
            showAuthorField();
        if (level >= 3)
            showGenreField();
//        if (level >= 7)
//            showPreviouslyLikedField();
        if (level >= 4)
            showKeyWordsField();

        if (level < 4) {
            nextButton.setVisibility(View.VISIBLE);
            resultButton.setVisibility(View.GONE);
        } else {
            resultButton.setVisibility(View.VISIBLE);
            nextButton.setVisibility(View.GONE);
        }
    }

    public void showAgeField() {
        ageLayout.setVisibility(View.VISIBLE);
    }

    public void showSexField() {
        sexLayout.setVisibility(View.VISIBLE);
    }

    public void showLikesReadingField() {
        likesReadingLayout.setVisibility(View.VISIBLE);
    }

    public void showLanguageField() {
        languageLayout.setVisibility(View.VISIBLE);

    }

    public void showAuthorField() {
        authorLayout.setVisibility(View.VISIBLE);
    }

    public void showGenreField() {
        genreLayout.setVisibility(View.VISIBLE);

    }

    public void showYearField() {
        yearLayout.setVisibility(View.VISIBLE);

    }

    public void showPreviouslyLikedField() {
        previouslyLikedLayout.setVisibility(View.VISIBLE);
    }

    public void showKeyWordsField() {
        keywordsLayout.setVisibility(View.VISIBLE);

    }

    // DRAWING FIELDS end
    //------------------------------------------------------------------------------------------------------
    @Override
    public void onClick(View v) {
        Integer defaultBackgroundColor = 0;
        switch (v.getId()) {
            case R.id.nextButton:
                showNextField();
                break;
            case R.id.resultButton:
                showResults();
                break;
//            case R.id.previousButton:
//                showPreviousField();
//                break;
            case R.id.removeButton:
                removeItem(v);
                break;
            case R.id.likesReadingY:
                v.setBackgroundColor(Color.GRAY);
                ((Button) findViewById(R.id.likesReadingN)).setBackgroundColor(defaultBackgroundColor);
                break;
            case R.id.likesReadingN:
                v.setBackgroundColor(Color.GRAY);
                ((Button) findViewById(R.id.likesReadingY)).setBackgroundColor(defaultBackgroundColor);
                break;
            case R.id.sexButtonF:
                v.setBackgroundColor(Color.GRAY);
                ((Button) findViewById(R.id.sexButtonM)).setBackgroundColor(defaultBackgroundColor);
                break;
            case R.id.sexButtonM:
                v.setBackgroundColor(Color.GRAY);
                ((Button) findViewById(R.id.sexButtonF)).setBackgroundColor(defaultBackgroundColor);
                break;
            case R.id.startYearButton:
                showYearDialog(v);
                break;
            case R.id.endYearButton:
                showYearDialog(v);
                break;
            case R.id.ageButton:
                showYearDialog(v);
                break;
//            case R.id.languageCheckboxEE:
//                toast("ajaeeeeeeeeeeeeeeeeeeeeeee");
//                toast("ajaeeeeeeeeeeeeeeeeeeeeeee");
//                toast("ajaeeeeeeeeeeeeeeeeeeeeeee");
//                break;
        }
    }

    private void showResults() {
        URLCreator urlCreator = new URLCreator();
        selection.setEnglish(((CheckBox) findViewById(R.id.languageCheckboxEN)).isChecked());
        selection.setEstonian(((CheckBox) findViewById(R.id.languageCheckboxEE)).isChecked());
        selection.setRussian(((CheckBox) findViewById(R.id.languageCheckboxRU)).isChecked());
        String url = urlCreator.createResultURL(selection);
        fetchDataFromServer("x", TASK_TYPE_RESULTS);
    }

    public void startResultActivity(List<Item> results) {
        DatabaseManagerSingleton.getInstance().setResults(results);
        Intent calendarStartIntent = new Intent(this, RecommendationResultList.class);
        startActivity(calendarStartIntent);
    }


    public void toast(String text) {
        Toast.makeText(getApplicationContext(), text, Toast.LENGTH_SHORT).show();
    }

    public void fetchDataFromServer(String characters, Integer type) {
        URLCreator urlCreator = new URLCreator();
        JsonTask jsonTask = new JsonTask(RecommendationActivity.this, type).setListener(this);
        String url = "";
        if (type == JsonTask.TASK_TYPE_AUTHOR_AUTOCOMPLETE) //author
            url = urlCreator.createAuthorAutoCompleteURL(characters);
        if (type == JsonTask.TASK_TYPE_GENRE_AUTOCOMPLETE) //genre
            url = urlCreator.createGenreAutoCompleteURL(characters);
        if (type == JsonTask.TASK_TYPE_KEYWORD_AUTOCOMPLETE) //keywords
            url = urlCreator.createKeywordsAutoCompleteURL(characters);
        if (type == TASK_TYPE_RESULTS) //keywords
            url = urlCreator.createResultURL(selection);
        jsonTask.execute(url);
    }


    //-----------------------------------------------------------------------------------------------------------------------
    // DEFAULT start:
    //-----------------------------------------------------------------------------------------------------------------------

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
//        if (id == R.id.action_settings) {
//            return true;
//        }

        return super.onOptionsItemSelected(item);
    }


    @Override
    public void authorAutoCompleteCallback(String inputCharacters) {
//        toast("authorAutoCompleteCallback");
//        toast("chaaaaaaaar:" + inputCharacters);
        fetchDataFromServer(inputCharacters, JsonTask.TASK_TYPE_AUTHOR_AUTOCOMPLETE);
    }

    @Override
    public void genreAutoCompleteCallback(String inputCharacters) {
//        toast("genreAutoCompleteCallback");
        fetchDataFromServer(inputCharacters, JsonTask.TASK_TYPE_GENRE_AUTOCOMPLETE);
    }

    @Override
    public void keywordAutoCompleteCallback(String inputCharacters) {
//        toast("keywordAutoCompleteCallback");
        fetchDataFromServer(inputCharacters, JsonTask.TASK_TYPE_KEYWORD_AUTOCOMPLETE);
    }

    @Override
    public void callback(String jsonString, Integer type) {
//        toast("jsonString type: " + type);
        HashMap<Integer, String> resultMap = DatabaseManagerSingleton.getInstance().parseIntegerKeyJsonToMap(jsonString);
        List<Item> items = DatabaseManagerSingleton.getInstance().stringHashMapToItemList(resultMap);
        startResultActivity(items);
//        toast(jsonString + "kokku:");
//        toast(String.valueOf(items.size()));
//        switch (type) {
//            case 0:
//                authorCallback(items);
//                break;
//            case 1:
//                genreCallback(items);
//                break;
//            case 2:
//                keywordCallback(items);
//                break;
//            case 3:
//                startResultActivity(items);
//                break;
//        }

//        DatabaseManagerSingleton.getInstance().setSchoolListResult(jsonString);
//        startMandatoryReadingActivity();
    }

//    private void showResultCallback(List<Item> items) {
//        System.out.println("as");
//         paned itemid kuskile mällu
//    }

    public void authorCallback(List<Item> itemList) {
        authorsAdapterList.clear();
        authorsAdapterList.addAll(itemList);
//        authorAdapter.addAll(itemList);
        authorAdapter.notifyDataSetChanged();
//        this.runOnUiThread(new Runnable() {
//            @Override
//            public void run() {
//            }
//        });
    }

    public void genreCallback(List<Item> itemList) {
        authorAdapter.clear();
        authorAdapter.addAll(itemList);
        authorAdapter.notifyDataSetChanged();
    }

    public void keywordCallback(List<Item> itemList) {
        keywordAdapter.clear();
        keywordAdapter.addAll(itemList);
        keywordAdapter.notifyDataSetChanged();
    }
}
